<?php

namespace App\Controllers;

use App\Models\Heroes\HeroType;
use App\Models\Heroes\Guerrier;
use App\Models\Heroes\Magicien;
use App\Models\Heroes\Voleur;
use App\Models\Level;
use App\Models\User;

class HeroController {

    /**
     * Gère la création d'un nouveau héros depuis le formulaire
     */
    public function create() {
        // 1. Vérification de la session (Sécurité)
        if (!isset($_SESSION['user'])) {
            header("Location: /login"); // Redirige si pas connecté
            exit();
        }

        // 2. Récupération et nettoyage des données POST
        $typeId   = isset($_POST['hero_type_id']) ? (int)$_POST['hero_type_id'] : null;
        $nickname = isset($_POST['hero_nickname']) ? htmlspecialchars(trim($_POST['hero_nickname'])) : '';

        if (!$typeId || empty($nickname)) {
            header("Location: /choix-hero?error=missing_data");
            exit();
        }

        // 3. Récupération des objets nécessaires
        $user   = $_SESSION['user'];
        $type   = HeroType::find($typeId);
        $level1 = Level::find(1); // On suppose que Level::find(1) existe pour le niveau de départ

        if (!$type) {
            header("Location: /choix-hero?error=invalid_type");
            exit();
        }

        // 4. Préparation des arguments pour le constructeur de Hero
        // L'ordre respecte exactement ton Hero.php
        $heroData = [
            null,               // ID (null pour auto-incrément)
            $nickname,          // Nom choisi par le joueur
            $type->getImage(),  // On hérite de l'image du type
            $type->getDescription(), // On hérite de la bio du type
            0,                  // XP de départ
            $type->getMaxPv(),
            $type->getMaxMana(),
            $type->getMaxStrength(),
            $type->getMaxInitiative(),
            $user,              // Instance de l'utilisateur
            null,               // Inventaire (sera géré après)
            $type,              // Instance de HeroType
            $level1,            // Instance de Level
            null,               // Armor_id
            null,               // Primary_weapon_id
            null                // Secondary_weapon_id
        ];

        // 5. Instanciation de la classe spécifique (Guerrier, Magicien, Voleur)
        $hero = null;
        switch ($type->getName()) {
            case 'Guerrier':
                $hero = new Guerrier(...$heroData);
                break;
            case 'Magicien':
                $hero = new Magicien(...$heroData);
                break;
            case 'Voleur':
                $hero = new Voleur(...$heroData);
                break;
            default:
                // Si le nom du type en BDD ne match pas, on peut créer une erreur
                header("Location: /choix-hero?error=unknown_class");
                exit();
        }

        // 6. Sauvegarde en base de données via ton Model Hero
        if ($hero) {
            $hero->save(); 
            
            // On enregistre l'ID du héros en session pour la suite du jeu
            $_SESSION['active_hero_id'] = $hero->getId();

            // Redirection vers le début de l'aventure
            header("Location: /aventure/start");
            exit();
        }
    }
}