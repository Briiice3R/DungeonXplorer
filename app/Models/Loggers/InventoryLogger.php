<?php
/*
namespace App\Models\Loggers;

use App\Models\Items\Inventory;
use App\Models\Loggers\Logger;
use App\Core\Database;

class InventoryLogger extends Logger
{

    public static function log($inventory)
    {
        if(!($inventory instanceof Inventory)){
            throw new \InvalidArgumentException("Expected Inventory instance");
        }
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO inventory_log (hero_id, item_id, quantity_change, reason, created_at) VALUES (:hero_id, :item_id, :quantity_change, :reason, :created_at)");
        $heroId = $inventory->getHero()->getId();
        $createdAt = date('Y-m-d H:i:s');


    }
}

*/

