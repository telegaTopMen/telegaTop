<?php

namespace App\service;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TgTopApiService
{
    protected Client $client;
    protected mixed $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.tg_top.key');

        $this->client = new Client([
            'base_uri' => 'https://tg-top.ru/api/v2',
        ]);
    }

    /**
     * @return mixed
     * @throws GuzzleException
     *
     * Получить услуги сервиса
     */
    public function getServices(): mixed
    {
        $response = $this->client->post('', [
            'form_params' => [
                'key' => $this->apiKey,
                'action' => 'services'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     *
     * Узнать текущий баланс
     */
    public function getBalance()
    {
        $response = $this->client->post('', [
            'form_params' => [
                'key' => $this->apiKey,
                'action' => 'balance'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function addOrder($serviceId, $link, $quantity)
    {
        $response = $this->client->post('', [
            'form_params' => [
                'key' => $this->apiKey,
                'action' => 'add',
                'service' => $serviceId,
                'link' => $link,
                'quantity' => $quantity
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
