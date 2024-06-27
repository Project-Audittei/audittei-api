<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumirAPITrait {
    private static function ObterDaAPI($url) {
        $config = [];

        if(env('ENVIRONMENT') == 'debug') $config = ['verify' => false];

        $cliente = new Client($config);
        $response = $cliente->request('GET', $url);
        
        $data = json_decode($response->getBody(), true);

        return $data;
    }
}