<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class DailyFood extends DataLayer
{
    public function __construct()
    {
        parent::__construct('daily_food', ['pig_id', 'date', 'food_id', 'amount'], 'id', true);
    }

    public function foodName()
    {
        return (new Food())->findById($this->food_id)->name;
    }
}
