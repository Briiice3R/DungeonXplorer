<?php

namespace App\Models\Items;
use App\Core\Database;
use App\Models\Heroes\Hero;
class Inventory
{
    /*** @var array<InventorySlot> $items */
    private array $items = [];
    private int $maxSlots;
    private Hero $hero;
    public function __construct($hero, $maxSlots)
    {
        $this->hero = $hero;
        $this->maxSlots = $maxSlots;
    }

    public function save():void
    {
        $db = Database::getInstance();

        // First, clear existing inventory for the hero
        $stmt = $db->prepare("DELETE FROM inventory WHERE hero_id = :hero_id");
        $stmt->execute([':hero_id' => $this->hero->getId()]);

        // Now, insert current items
        $stmt = $db->prepare("INSERT INTO inventory (hero_id, item_id, quantity) VALUES (:hero_id, :item_id, :quantity)");
        foreach ($this->items as $inventorySlot) {
            $stmt->execute([
                ':hero_id' => $this->hero->getId(),
                ':item_id' => $inventorySlot->getItem()->getId(),
                ':quantity' => $inventorySlot->getQuantity()
            ]);
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }
    public function getMaxSlots(): int
    {
        return $this->maxSlots;
    }
    public function getHero(): Hero
    {
        return $this->hero;
    }



    public function addItem(InventorySlot $item): bool
    {
        if (count($this->items) >= $this->maxSlots) {
            return false; // Inventory full
        }
        $this->items[] = $item;
        return true;
    }
    public function removeItem(InventorySlot $item, int $quantity): bool
    {
        foreach ($this->items as $key => $inventoryItem) {
            if ($inventoryItem->getItem() === $item->getItem()) {
                if ($inventoryItem->getQuantity() >= $quantity) {
                    $inventoryItem->reduceQuantity($quantity);
                    if ($inventoryItem->getQuantity() === 0) {
                        unset($this->items[$key]);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function loadInventory(): void{
        $db = Database::getInstance();

        $stmt = $db->prepare("SELECT * FROM inventory WHERE hero_id = :hero_id");
        $stmt->execute([':hero_id' => $this->hero->getId()]);
        $results = $stmt->fetchAll();
        foreach($results as $row){
            $item = Item::find($row['item_id']);
            if($item){
                $this->items[] = new InventorySlot($item, $row['quantity']);
            }
        }
    }

    public function isFull(): bool
    {
        return count($this->items) >= $this->maxSlots;
    }
}