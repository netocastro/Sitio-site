<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Breed extends DataLayer
{
    public function __construct()
    {
        parent::__construct('breeds', ['name'], 'id', true);
    }

}
