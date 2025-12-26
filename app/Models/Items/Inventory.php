<?php

namespace App\Models\Items;

use App\Core\Database;
use App\Models\Heroes\Hero;

class Inventory
{
    /** @var array<InventorySlot> $items */
    private array $items = [];
    private int $maxSlots;
    private Hero $hero;

    public function __construct($hero, $maxSlots)
    {
        $this->hero = $hero;
        $this->maxSlots = $maxSlots;
    }

    /**
     * Sauvegarde l'inventaire complet en base de données
     */
    public function save(): void
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("DELETE FROM Inventory WHERE hero_id = :hero_id");
        $stmt->execute([':hero_id' => $this->hero->getId()]);

        $stmt = $db->prepare("INSERT INTO Inventory (hero_id, item_id, quantity) VALUES (:hero_id, :item_id, :quantity)");
        foreach ($this->items as $inventorySlot) {
            $stmt->execute([
                ':hero_id' => $this->hero->getId(),
                ':item_id' => $inventorySlot->getItem()->getId(),
                ':quantity' => $inventorySlot->getQuantity()
            ]);
        }
    }

    /**
     * Ajoute un objet à l'inventaire.
     * Accepte un objet InventorySlot OU un entier (ID de l'item).
     */
    public function addItem($item, int $quantity = 1): bool
    {
        if (is_int($item)) {
            $itemObject = Item::find($item);
            if (!$itemObject) {
                return false;
            }
            $item = new InventorySlot($itemObject, $quantity);
        }

        // Vérification si l'item est déjà présent pour augmenter la quantité
        foreach ($this->items as $slot) {
            if ($slot->getItem()->getId() === $item->getItem()->getId()) {
                $slot->addQuantity($item->getQuantity());
                $this->save();
                return true;
            }
        }

        // Vérification de la place disponible
        if (count($this->items) >= $this->maxSlots) {
            return false;
        }

        $this->items[] = $item;
        $this->save();
        return true;
    }

    public function removeItem(InventorySlot $item, int $quantity): bool
    {
        foreach ($this->items as $key => $inventoryItem) {
            if ($inventoryItem->getItem()->getId() === $item->getItem()->getId()) {
                if ($inventoryItem->getQuantity() >= $quantity) {
                    $inventoryItem->reduceQuantity($quantity);
                    if ($inventoryItem->getQuantity() <= 0) {
                        unset($this->items[$key]);
                        $this->items = array_values($this->items); // Réindexer le tableau
                    }
                    $this->save();
                    return true;
                }
            }
        }
        return false;
    }

    public function loadInventory(): void
    {
        $db = Database::getInstance();
        $this->items = [];

        $stmt = $db->prepare("SELECT * FROM Inventory WHERE hero_id = :hero_id");
        $stmt->execute([':hero_id' => $this->hero->getId()]);
        $results = $stmt->fetchAll();

        foreach ($results as $row) {
            $item = Item::find($row['item_id']);
            if ($item) {
                $this->items[] = new InventorySlot($item, $row['quantity']);
            }
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

    public function isFull(): bool
    {
        return count($this->items) >= $this->maxSlots;
    }
}