<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Food extends DataLayer
{
    public function __construct()
    {
        parent::__construct('foods', ['name','user_id'], 'id', true);
    }
}
