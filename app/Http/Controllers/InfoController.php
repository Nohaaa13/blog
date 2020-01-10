<?php

namespace App\Http\Controllers\App;

use App\Entity\Exam;
use App\Entity\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{

    public function __construct()
    {

    }


    public function info(Request $request)
    {

        $category = $request->get('category');
        $clients = Exam::query()->where('category','=', $category)->get();
        $Ids = array();
        foreach ($clients as $client)
        {
            $I =  array(
                'title' => $client->title,
                'url' => $client->url
            );
            array_push($Ids, $I  );
            ;
        }

        return response()->json(
            $Ids
        )->header('Access-Control-Allow-Origin', '*')->header('Accept', 'application/json')->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Methods', 'GET, POST')->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Credentials', 'true') ->header('Access-Control-Max-Age', '86400')
            ->header('Access-Control-Request-Headers', '*');

    }

    public function discountInfo(Request $request)
    {

        $token = $request->get('token');
        $client = Client::query()->where('token','=', $token)->get()->first();
        $discountCard = $client->discountCard()->get()->first();
        $disc = $discountCard->disc;
        $number = $discountCard->number;
        if ($discountCard->type == DiscountCard::TYPE_CUMULATIVE)
        $type = "Накопительная скидка";
         elseif ($discountCard->type == DiscountCard::TYPE_FIXED)
         $type = "Фиксированная скидка";

        return response()->json([
            "number" => "$number",
            "discount_size" => "$disc",
            "type" => "$type"
        ]);

    }

    public function cars(Request $request)
    {

        $token = $request->get('token');
        $client = Client::query()->where('token','=', $token)->get()->first();
        $cars = $client->cars()->get();
        $Ids = array();
        foreach ($cars as $car)
        {
            $I =  array(
                'number' => $car->number,
                'carMark' => $car->carMark->name,
                'carModel' =>  $car->carModel ? $car->carModel->name : ''
            );
            array_push($Ids, $I  );
           ;
        }

        return response()->json(
            $Ids
        );

    }

    public function servicehistory(Request $request)
    {

        $token = $request->get('token');
        $client = Client::query()->where('token','=', $token)->get()->first();
        $orders = $client->orders()->limit(10)->get();
        $Ids = array();
        foreach ($orders as $order)
        {
            $I =  array(
                'id' => $order->id,
                'serviceCenter' => $order->serviceCenter->name,
                'number' => $order->car->number,
                'time' => dataTimeFormat($order->created_at)
            );
            array_push($Ids, $I  );
            ;
        }

        return response()->json(
            $Ids
        );

    }

}
