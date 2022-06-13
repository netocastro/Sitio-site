<?php

namespace Source\Controllers\Admin;

use Source\Models\DailyFood;
use Source\Models\FeedPurchasesHistoric;
use Source\Models\Pig;

class RequestAdmin
{
    public function dailyFoods($data)
    {
        $date = filter_var($data['date'], FILTER_SANITIZE_STRING);

        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $dailyFoods = (new DailyFood())->find('user_id = :uid and date = :d', "uid={$user}&d={$date}")->fetch(true);

        if ($dailyFoods) {
            foreach ($dailyFoods as $dailyFood) {
                $dailyFood->foodName = $dailyFood->foodName();
            }
        }

        echo json_encode(objectToArray($dailyFoods));
    }
   
    public function myShopping($data)
    {
        $date = filter_var($data['date'], FILTER_SANITIZE_STRING);

        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $feedPurchasesHistoric = (new FeedPurchasesHistoric())->find('user_id = :uid and date = :d', "uid={$user}&d={$date}")->fetch(true);

        if ($feedPurchasesHistoric) {
            foreach ($feedPurchasesHistoric as $food) {
                $food->foodName = $food->foodName();
            }
        }

        echo json_encode(objectToArray($feedPurchasesHistoric));
    }
}   
