<?php

namespace App\Controllers;

use App\Models\User;

class AdminController {
    public function index() {
        @session_start();
        $user = null;
        if (isset($_SESSION['userId'])) {
            $user = User::find($_SESSION['userId']);
        }

        if (!$user || !$user->isAdmin()) {
            header('HTTP/1.0 403 Forbidden');
            echo "Accès refusé : Réservé aux administrateurs.";
            exit();
        }

        $db = \App\Core\Database::getInstance();
        
        // Liste des utilisateurs
        $stmt = $db->query("SELECT id, username, email, created_at FROM User WHERE admin != 1 ORDER BY created_at DESC");
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Gérer la Forge du Monde
        $type = $_GET['type'] ?? 'chapters';
        $forgeItems = [];

        if ($type === 'chapters') {
            // Vérifie si c'est 'Chapter' ou 'chapter' dans ta BDD. D'après l'erreur, tente avec Majuscule :
            $stmt = $db->query("SELECT id, title, image FROM Chapter ORDER BY id ASC");
            $forgeItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } elseif ($type === 'monsters') {
            $stmt = $db->query("SELECT id, name FROM Monster ORDER BY id ASC");
            $forgeItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } elseif ($type === 'treasures') {
            $stmt = $db->query("SELECT t.item_id as id, i.name as title, t.chapter_id as subtitle, t.quantity FROM Treasure t JOIN Item i ON t.item_id = i.id ORDER BY t.chapter_id ASC");
            $forgeItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        // Statistiques
        $stats = [
            'chapters' => $db->query("SELECT COUNT(*) FROM Chapter")->fetchColumn(),
            'monsters' => $db->query("SELECT COUNT(*) FROM Monster")->fetchColumn(),
            'heroes'   => $db->query("SELECT COUNT(*) FROM Hero")->fetchColumn()
        ];

        include __DIR__ . '/../../resources/views/AdminDashboard.php';
    }

    public function deleteContent($type, $id) {
        @session_start();
        $admin = \App\Models\User::find($_SESSION['userId'] ?? 0);
        if (!$admin || !$admin->isAdmin()) {
            header('HTTP/1.0 403 Forbidden');
            exit("Accès refusé.");
        }

        $db = \App\Core\Database::getInstance();
        $successKey = "";
        $redirectType = $type;

        // Suppression selon le type
        switch ($type) {
            case 'user':
                // Sécurité : on ne supprime pas un admin
                $stmt = $db->prepare("DELETE FROM User WHERE id = :id AND admin != 1");
                $stmt->execute([':id' => $id]);
                $successKey = "suppruser";
                break;

            case 'chapters':
                $db->prepare("DELETE FROM Chapter WHERE id = :id")->execute([':id' => $id]);
                $successKey = "supprchap";
                break;

            case 'monsters':
                $db->prepare("DELETE FROM Monster WHERE id = :id")->execute([':id' => $id]);
                $successKey = "supprmonstre";
                break;

            case 'treasures':
                $db->prepare("DELETE FROM Treasure WHERE item_id = :id")->execute([':id' => $id]);
                $successKey = "supprtreasure";
                break;
                
            default:
                header("Location: /DungeonXplorer/admin/dashboard?error=type_inconnu");
                exit();
        }

        // 3. Redirection unique
        header("Location: /DungeonXplorer/admin/dashboard?type=$redirectType&success=$successKey");
        exit();
    }

    public function getForgeData($type, $id) {
        @session_start();
        $admin = \App\Models\User::find($_SESSION['userId'] ?? 0);
        if (!$admin || !$admin->isAdmin()) {
            header('HTTP/1.0 403 Forbidden');
            exit("Accès refusé.");
        }
        $db = \App\Core\Database::getInstance();
        
        // Déterminer le nom de la table et de la colonne ID
        if ($type === 'chapters') {
            $tableName = 'Chapter';
            $idColumn = 'id';
        } elseif ($type === 'monsters') {
            $tableName = 'Monster';
            $idColumn = 'id';
        } else {
            $tableName = 'Treasure';
            $idColumn = 'item_id';
        }

        $stmt = $db->prepare("SELECT * FROM $tableName WHERE $idColumn = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function updateContent($type, $id) {
        @session_start();
        $admin = \App\Models\User::find($_SESSION['userId'] ?? 0);
        if (!$admin || !$admin->isAdmin()) {
            header('HTTP/1.0 403 Forbidden');
            exit("Accès refusé.");
        }
    
        $db = \App\Core\Database::getInstance();
    
        if ($type === 'chapters') {
            $stmt = $db->prepare("UPDATE Chapter SET title = :t, description = :d, image = :i WHERE id = :id");
            $stmt->execute([
                ':t'  => $_POST['display_name'],
                ':d'  => $_POST['description'],
                ':i'  => $_POST['image'],
                ':id' => $id
            ]);
        } elseif ($type === 'monsters') {
            $stmt = $db->prepare("UPDATE Monster SET name = :n, pv = :pv, mana = :mana, strength = :s, drop_xp = :xp WHERE id = :id");
            $stmt->execute([
                ':n'    => $_POST['display_name'],
                ':pv'   => $_POST['pv'],
                ':mana' => $_POST['mana'],
                ':s'    => $_POST['strength'],
                ':xp'   => $_POST['drop_xp'],
                ':id'   => $id
            ]);
        } elseif ($type === 'treasures') {
            $stmt = $db->prepare("UPDATE Treasure SET chapter_id = :c, quantity = :qt WHERE item_id = :id");
            $stmt->execute([
                ':c'  => $_POST['display_chapter'],
                ':qt' => $_POST['quantite'],
                ':id' => $id
            ]);
        }
    
        header("Location: /DungeonXplorer/admin/dashboard?type=$type&success=updateok");
        exit();
    }

    public function addContent($type) {
        @session_start();
        $admin = \App\Models\User::find($_SESSION['userId'] ?? 0);
        if (!$admin || !$admin->isAdmin()) {
            header('HTTP/1.0 403 Forbidden');
            exit("Accès refusé.");
        }
        
        $db = \App\Core\Database::getInstance();
    
        if ($type === 'chapters') {
            $stmt = $db->prepare("INSERT INTO Chapter (title, description, image) VALUES (:t, :d, :i)");
            $stmt->execute([
                ':t' => $_POST['display_name'],
                ':d' => $_POST['description'],
                ':i' => $_POST['image']
            ]);
        } elseif ($type === 'monsters') {
            $stmt = $db->prepare("INSERT INTO Monster (name, pv, mana, strength, drop_xp) VALUES (:n, :pv, :mana, :s, :xp)");
            $stmt->execute([
                ':n'    => $_POST['display_name'],
                ':pv'   => $_POST['pv'],
                ':mana' => $_POST['mana'],
                ':s'    => $_POST['strength'],
                ':xp'   => $_POST['drop_xp']
            ]);
        } elseif ($type === 'treasures') {
            $stmt = $db->prepare("INSERT INTO Treasure (chapter_id, item_id, quantity) VALUES (:c, :item, :qt)");
            $stmt->execute([
                ':c'    => $_POST['display_chapter'],
                ':item' => $_POST['item_id'],
                ':qt'   => $_POST['quantite'],
            ]);
        }
    
        header("Location: /DungeonXplorer/admin/dashboard?type=$type&success=addok");
        exit();
    }

}