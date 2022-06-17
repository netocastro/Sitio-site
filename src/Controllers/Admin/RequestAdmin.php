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
                $dailyFood->amount = number_format($dailyFood->amount, 3, ',', '.');
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

    public function changeVaccination($data)
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pig = (new Pig())->find('user_id = :uid and id = :d', "uid={$user}&d={$data['id']}")->fetch();

        if (!$pig) {
            echo json_encode(["pigStatusError" => 'Porco nao cadastrado']);
            return;
        }

        if ($pig->vaccination) {
            $pig->vaccination = false;
            $pig->change()->save();
        } else {
            $pig->vaccination = true;
            $pig->change()->save();
        }

        if ($pig->fail()) {
            echo json_encode($pig->fail()->getMessage());
            return;
        }

        echo json_encode(["pigStatus" => $pig->vaccination]);
    }

    public function changeSerratedTeeth($data)
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pig = (new Pig())->find('user_id = :uid and id = :d', "uid={$user}&d={$data['id']}")->fetch();

        if (!$pig) {
            echo json_encode(["pigStatusError" => 'Porco nao cadastrado']);
            return;
        }

        if ($pig->serrated_teeth) {
            $pig->serrated_teeth = false;
            $pig->change()->save();
        } else {
            $pig->serrated_teeth = true;
            $pig->change()->save();
        }

        if ($pig->fail()) {
            echo json_encode($pig->fail()->getMessage());
            return;
        }

        echo json_encode(["pigStatus" => $pig->serrated_teeth]);
    }
}
