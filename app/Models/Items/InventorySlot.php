<?php

namespace App\Models\Items;
use App\Core\Database;
class InventorySlot
{
    private ?Item $item;
    private int $quantity;
    public function __construct(Item $item, int $quantity)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    public function getItem(): Item
    {
        return $this->item;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function addQuantity(int $amount): void
    {
        $this->quantity += $amount;
    }
    public function reduceQuantity(int $amount):void{
        $this->quantity -= $amount;
    }
}