<?php

namespace Source\Controllers\Admin;

use Source\Models\DailyFood;
use Source\Models\Pig;

class RequestAdmin
{
    public function dailyFoods($data)
    {
        $date = filter_var($data['date'], FILTER_SANITIZE_STRING);

        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pigs = (new Pig())->find('user_id = :ui', "ui={$user}")->fetch(true);

        $feederPigs = [];

        foreach ($pigs as $pig) {
            if ($pig->dailyFood($date)) {
                $aux = $pig->dailyFood($date)->data();
                $aux->foodName = $pig->dailyFood($date)->foodName();
                $feederPigs[] = $aux;
            }
        }

        echo json_encode($feederPigs);
    }
}

/* 
    $date = filter_var($data['date'], \FILTER_SANITIZE_STRING);

    $dailyFoods = (new DailyFood())->find('date = :d', "d={$date}")->fetch(true);

    if ($dailyFoods) {
        foreach ($dailyFoods as $dailyFood) {
            $dailyFood->foodName = $dailyFood->foodName();
        }
    }

    echo json_encode(objectToArray($dailyFoods));
 */
