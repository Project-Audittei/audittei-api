<?php

namespace App\Services;

use GuzzleHttp\Client;

class APIClienteService
{
    public static function get($url)
    {
        $config = [];
    
        if(env('ENVIRONMENT') == 'debug') $config = ['verify' => false];

        $cliente = new Client($config);
        $response = $cliente->request('GET', $url);
        
        $data = json_decode($response->getBody(), true);

        return $data;
    }
}
