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
        
        $allMonsters = $db->query("SELECT id, name FROM Monster ORDER BY name")->fetchAll(\PDO::FETCH_ASSOC);
        $allItems = $db->query("SELECT id, name FROM Item ORDER BY name")->fetchAll(\PDO::FETCH_ASSOC);
        $allChapters = $db->query("SELECT id, title FROM Chapter ORDER BY id")->fetchAll(\PDO::FETCH_ASSOC);
        $monsterTypes = $db->query("SELECT id, name FROM Monster_Type ORDER BY id ASC")->fetchAll(\PDO::FETCH_ASSOC);

        // Liste des utilisateurs
        $stmt = $db->query("SELECT id, username, email, created_at FROM User WHERE admin != 1 ORDER BY created_at DESC");
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Gérer la Forge du Monde
        $type = $_GET['type'] ?? 'chapters';
        $forgeItems = [];

        if ($type === 'chapters') {
            $stmt = $db->query("SELECT id, title, image FROM Chapter ORDER BY id ASC");
            $forgeItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } elseif ($type === 'monsters') {
            $stmt = $db->query("SELECT id, name, description FROM Monster ORDER BY id ASC");
            $forgeItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } elseif ($type === 'treasures') {
            $stmt = $db->query("SELECT t.item_id as id, i.name as title, c.title as subtitle, t.quantity, t.chapter_id as chapter_num FROM Treasure t JOIN Item i ON t.item_id = i.id JOIN Chapter c ON t.chapter_id = c.id ORDER BY t.chapter_id ASC");
            $forgeItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        // Statistiques
        $stats = [
            'chapters' => $db->query("SELECT COUNT(*) FROM Chapter")->fetchColumn(),
            'monsters' => $db->query("SELECT COUNT(*) FROM Monster")->fetchColumn(),
            'heroes'   => $db->query("SELECT COUNT(*) FROM Hero")->fetchColumn()
        ];

        // Récupération des images du dossier
        $imageDir = __DIR__ . '/../../resources/images/';
        $images = [];
        if (is_dir($imageDir)) {
            // Scanne le dossier et filtre pour ne garder que les images
            $files = scandir($imageDir);
            foreach ($files as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                    $images[] = $file;
                }
            }
        }

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

        // Si c'est un chapitre, on ajoute les données liées
        if ($type === 'chapters' && $data) {
            // Monstre lié (Table Chapter_Monster)
            $data['monster_id'] = $db->query("SELECT monster_id FROM Chapter_Monster WHERE chapter_id = $id")->fetchColumn();
            
            // Objet simple (Table Chapter_item)
            $data['item_id_simple'] = $db->query("SELECT item_id FROM Chapter_item WHERE chapter_id = $id")->fetchColumn();
            
            // Trésor quantifiable (Table Treasure)
            $treasure = $db->query("SELECT item_id, quantity FROM Treasure WHERE chapter_id = $id")->fetch(\PDO::FETCH_ASSOC);
            $data['treasure_item_id'] = $treasure['item_id'] ?? null;
            $data['treasure_qty'] = $treasure['quantity'] ?? null;
            
            // Choix de destination (Table Chapter_Choice)
            $choices = $db->query("SELECT to_chapter_id, choice_text FROM Chapter_Choice WHERE from_chapter_id = $id")->fetchAll(\PDO::FETCH_ASSOC);
            $data['choices'] = $choices ?: [];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    

    private function uploadImage($file, $id = null) {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../resources/images/';
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($extension, $allowedExt)) return null;

            // Nom unique : 'chapter_ID.ext' ou 'chapter_TIMESTAMP.ext' si nouvel ajout
            $nameTag = $id ? $id : time();
            $filename = 'chapter' . $nameTag . '.' . $extension;
            
            if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                return 'resources/images/' . $filename;
            }
        }
        return null;
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
            $db->beginTransaction();
            try {
                // 1. Insertion du Chapitre (Toujours obligatoire)
                $imagePath = $this->uploadImage($_FILES['image'] ?? null);
                $stmt = $db->prepare("INSERT INTO Chapter (title, description, image) VALUES (:t, :d, :i)");
                $stmt->execute([':t' => $_POST['display_name'], ':d' => $_POST['description'], ':i' => $imagePath]);
                $newId = $db->lastInsertId();
    
                // 2. Liaison Monstre (Facultatif)
                if (!empty($_POST['monster_id'])) {
                    $db->prepare("INSERT INTO Chapter_Monster (chapter_id, monster_id) VALUES (:c, :m)")
                       ->execute([':c' => $newId, ':m' => $_POST['monster_id']]);
                }
    
                // 3. Liaison Objet Simple (chapter_item - Facultatif)
                if (!empty($_POST['item_id_simple'])) {
                    $db->prepare("INSERT INTO Chapter_item (chapter_id, item_id) VALUES (:c, :i)")
                       ->execute([':c' => $newId, ':i' => $_POST['item_id_simple']]);
                }
    
                // 4. Liaison Trésor avec Quantité (Treasure - Facultatif)
                if (!empty($_POST['treasure_item_id']) && !empty($_POST['treasure_qty'])) {
                    $db->prepare("INSERT INTO Treasure (chapter_id, item_id, quantity) VALUES (:c, :i, :q)")
                       ->execute([':c' => $newId, ':i' => $_POST['treasure_item_id'], ':q' => $_POST['treasure_qty']]);
                }
    
                // 5. Liaison Choix (Chapter_Choice - Facultatif)
                if (!empty($_POST['to_chapter_id'])) {
                    foreach ($_POST['to_chapter_id'] as $key => $toId) {
                        $text = $_POST['choice_text'][$key] ?? '';
                        if (!empty($toId) && !empty($text)) {
                            $db->prepare("INSERT INTO Chapter_Choice (from_chapter_id, to_chapter_id, choice_text) VALUES (:f, :t, :txt)")
                               ->execute([':f' => $newId, ':t' => $toId, ':txt' => $text]);
                        }
                    }
                }
    
                $db->commit();
            } catch (\Exception $e) {
                $db->rollBack();
                exit("Erreur Forge: " . $e->getMessage());
            }
        } elseif ($type === 'monsters') {
            $stmt = $db->prepare("INSERT INTO Monster (name, description, pv, mana, strength, initiative, drop_xp, monster_type_id) VALUES (:n, :desc, :pv, :mana, :s, :ini, :xp, :type_id)");
            $stmt->execute([':n' => $_POST['display_name'], ':desc' => $_POST['display_desc'] ,':pv' => $_POST['pv'], ':mana' => $_POST['mana'], ':s' => $_POST['strength'], ':ini' => $_POST['initiative'], ':xp' => $_POST['drop_xp'], ':type_id' => $_POST['monster_type_id']]);
        } elseif ($type === 'treasures') {
            $stmt = $db->prepare("INSERT INTO Treasure (chapter_id, item_id, quantity) VALUES (:c, :i, :q)");
            $stmt->execute([':c' => $_POST['display_chapter'], ':i' => $_POST['item_id'], ':q' => $_POST['quantite']]);
        }
        header("Location: /DungeonXplorer/admin/dashboard?type=$type&success=addok");
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
            $db->beginTransaction();
            try {
                // 1. Mise à jour du chapitre
                $imagePath = $this->uploadImage($_FILES['image'] ?? null, $id);
                $sql = "UPDATE Chapter SET title = :t, description = :d" . ($imagePath ? ", image = :i" : "") . " WHERE id = :id";
                $params = [':t' => $_POST['display_name'], ':d' => $_POST['description'], ':id' => $id];
                if($imagePath) $params[':i'] = $imagePath;
                $db->prepare($sql)->execute($params);

                // Nettoyage et mise à jour des liaisons (Delete then Insert)
                
                // Monstre
                $db->prepare("DELETE FROM Chapter_Monster WHERE chapter_id = :id")->execute([':id' => $id]);
                if (!empty($_POST['monster_id'])) {
                    $db->prepare("INSERT INTO Chapter_Monster (chapter_id, monster_id) VALUES (:c, :m)")->execute([':c' => $id, ':m' => $_POST['monster_id']]);
                }

                // Objet simple
                $db->prepare("DELETE FROM Chapter_item WHERE chapter_id = :id")->execute([':id' => $id]);
                if (!empty($_POST['item_id_simple'])) {
                    $db->prepare("INSERT INTO Chapter_item (chapter_id, item_id) VALUES (:c, :i)")->execute([':c' => $id, ':i' => $_POST['item_id_simple']]);
                }

                // Trésor (On utilise chapter_id comme pivot)
                $db->prepare("DELETE FROM Treasure WHERE chapter_id = :id")->execute([':id' => $id]);
                if (!empty($_POST['treasure_item_id'])) {
                    $db->prepare("INSERT INTO Treasure (chapter_id, item_id, quantity) VALUES (:c, :i, :q)")
                    ->execute([':c' => $id, ':i' => $_POST['treasure_item_id'], ':q' => $_POST['treasure_qty']]);
                }

                // Choix
                $db->prepare("DELETE FROM Chapter_Choice WHERE from_chapter_id = :id")->execute([':id' => $id]);
                if (!empty($_POST['to_chapter_id'])) {
                    foreach ($_POST['to_chapter_id'] as $key => $toId) {
                        $text = $_POST['choice_text'][$key] ?? '';
                        if (!empty($toId) && !empty($text)) {
                            $db->prepare("INSERT INTO Chapter_Choice (from_chapter_id, to_chapter_id, choice_text) VALUES (:f, :t, :txt)")
                               ->execute([':f' => $id, ':t' => $toId, ':txt' => $text]); // Utilisez $id au lieu de $newId pour l'update
                        }
                    }
                }

                $db->commit();
            } catch (\Exception $e) {
                $db->rollBack();
                exit("Erreur update: " . $e->getMessage());
            }
        } elseif ($type === 'monsters') {
            $stmt = $db->prepare("UPDATE Monster SET name = :n, description = :desc, pv = :pv, mana = :mana, strength = :s, initiative = :ini, drop_xp = :xp, monster_type_id = :type_id WHERE id = :id");
            $stmt->execute([':n' => $_POST['display_name'], ':desc' => $_POST['display_desc'], ':pv' => $_POST['pv'], ':mana' => $_POST['mana'], ':s' => $_POST['strength'], ':ini' => $_POST['initiative'], ':xp' => $_POST['drop_xp'], ':type_id' => $_POST['monster_type_id'], ':id' => $id
            ]);
        } elseif ($type === 'treasures') {
            // Suppression/Réinsertion pour gérer le changement d'ID item
            $db->prepare("DELETE FROM Treasure WHERE item_id = :old_id")->execute([':old_id' => $id]);
            $db->prepare("INSERT INTO Treasure (chapter_id, item_id, quantity) VALUES (:c, :i, :q)")->execute([':c' => $_POST['display_chapter'], ':i' => $_POST['item_id'], ':q' => $_POST['quantite']]);
        }

        header("Location: /DungeonXplorer/admin/dashboard?type=$type&success=updateok");
        exit();
    }

    public function deleteImage($filename) {
        @session_start();
        $admin = \App\Models\User::find($_SESSION['userId'] ?? 0);
        if (!$admin || !$admin->isAdmin()) {
            header('HTTP/1.0 403 Forbidden');
            exit();
        }
    
        // Sécurité : on empêche de sortir du dossier images via le nom de fichier
        $filename = basename($filename);
        $filePath = __DIR__ . '/../../resources/images/' . $filename;
    
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath); // Supprime le fichier
        }
    
        header("Location: /DungeonXplorer/admin/dashboard?success=supprimg");
        exit();
    }
}