<?php

namespace App\Controllers;

use App\Models\Heroes\Hero;
use App\Models\Heroes\HeroType;
use App\Models\Heroes\Guerrier;
use App\Models\Heroes\Magicien;
use App\Models\Heroes\Voleur;
use App\Models\Level;
use App\Models\User;
use App\Core\Database;

class HeroController {

    /**
     * Gère la création d'un nouveau héros depuis le formulaire
     */
    public function create() {
        // 1. Vérification de la session (Sécurité)
        // On s'assure que l'utilisateur est connecté avant de créer quoi que ce soit
        if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            header("Location: ./login"); 
            exit();
        }

        // 2. Récupération et nettoyage des données envoyées par le formulaire
        $typeId   = isset($_POST['hero_type_id']) ? (int)$_POST['hero_type_id'] : null;
        $nickname = isset($_POST['hero_nickname']) ? htmlspecialchars(trim($_POST['hero_nickname'])) : '';

        // Si des données manquent, on renvoie à la page de création avec un message d'erreur
        if (!$typeId || empty($nickname)) {
            header("Location: ./aventurecreate?error=missing_data");
            exit();
        }

        // 3. Récupération des objets nécessaires via les Modèles
        $userId = $_SESSION['userId'];
        $type   = HeroType::find($typeId);
        $level1 = Level::find(1); // Le héros commence toujours au niveau 1

        if (!$type) {
            header("Location: ./aventurecreate?error=invalid_type");
            exit();
        }

        // 4. Préparation des données pour le constructeur
        $userObj = \App\Models\User::find($_SESSION['userId']); // On récupère l'OBJET User
        $heroData = [
            null,                // ID : null car géré par la séquence Oracle
            $nickname,           // Nom choisi par le joueur
            $type->getImage(),   // Image héritée du type de héros
            $type->getDescription(), // Bio héritée du type
            0,                   // XP de départ
            $type->getMaxPv(),   // PV actuels (au max au début)
            $type->getMaxMana(),
            $type->getMaxStrength(),
            $type->getMaxInitiative(),
            $userObj,             // USER_ID (Clé étrangère)
            null,                // Inventaire (Initialement vide)
            $type,               // Objet HeroType
            $level1,             // Objet Level
            null,                // ARMOR_ID
            null,                // PRIMARY_WEAPON_ID
            null                 // SECONDARY_WEAPON_ID
        ];

        // 5. Instanciation de la classe spécifique selon le nom du type (en MAJUSCULES pour Oracle)
        $hero = null;
        $typeName = strtoupper($type->getName()); 

        switch ($typeName) {
            case 'GUERRIER':
                $hero = new Guerrier(...$heroData);
                break;
            case 'MAGICIEN':
                $hero = new Magicien(...$heroData);
                break;
            case 'VOLEUR':
                $hero = new Voleur(...$heroData);
                break;
            default:
                // Si le nom ne correspond à aucune classe PHP connue
                header("Location: ./aventurecreate?error=unknown_class");
                exit();
        }

        // 6. Sauvegarde, Initialisation Progression et Redirection
        if ($hero) {
            // La méthode save() doit gérer l'INSERT INTO HEROES
            $hero->save(); 
            
            // On récupère l'ID réel du héros et on l'a stock dans la session
            $currentHeroId = $hero->getId();
            $_SESSION['active_hero_id'] = $currentHeroId;

            // --- AJOUT : INITIALISATION DE LA TABLE PROGRESSION ---
            // On crée la première ligne au chapitre 1 pour que le héros apparaisse dans l'accueil
            $db = Database::getInstance();
            $stmt = $db->prepare("INSERT INTO Progression (hero_id, chapter_id, start_date) VALUES (:h, 1, NOW())");
            $stmt->execute([':h' => $currentHeroId]);
            // ------------------------------------------------------

            // Redirection vers le début de l'histoire
            header("Location: /DungeonXplorer/chapter/1");
            exit();
        }
    }
}