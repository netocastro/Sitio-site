<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class FoodStock extends DataLayer
{
    public function __construct()
    {
        parent::__construct('food_stock', ['user_id', 'food_id', 'amount'], 'id', true);
    }

    public function foodName()
    {
        return (new Food())->findById($this->food_id)->name;
    }
}
