<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class FeedPurchasesHistoric extends DataLayer
{
    public function __construct()
    {
        parent::__construct('feed_purchases_historic', ['user_id', 'food_id', 'date', 'amount', 'price'], 'id', true);
    }

    public function foodName()
    {
        return (new Food())->findById($this->food_id)->name;
    }
}
