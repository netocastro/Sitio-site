<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Pig extends DataLayer
{
    public function __construct()
    {
        parent::__construct('pigs', ['name', 'user_id', 'breed_id', 'birthday', 'slaughter_day', 'serrated_teeth', 'vaccination', 'starting_weight'], 'id', true);
    }

    public function breedName()
    {
        return (new Breed())->findById($this->breed_id)->name;
    }

    public function dailyFood($date)
    {
        return (new DailyFood())->find('date = :date and pig_id = :pi', "date={$date}&pi={$this->id}")->fetch();
    }
}
