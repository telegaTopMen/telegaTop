<?php

namespace App\Http\Controllers;

use App\service\TgTopApiService;
use GuzzleHttp\Exception\GuzzleException;

class TgTopController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function services(TgTopApiService $service)
    {
       return $service->getServices();
    }

    /**
     * @throws GuzzleException
     */
    public function balance(TgTopApiService $balance)
    {
        return $balance->getBalance();
    }

}
