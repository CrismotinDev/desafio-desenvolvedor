<?php

namespace App\Services\ApiConversaoValores;

use GuzzleHttp\Client;

class ConversaoValoresService
{
    
    public function obterValorMoedaDestino(string $moedaDestino): float
    {
        $url = "https://economia.awesomeapi.com.br/json/last/BRL-{$moedaDestino}";

        $client = new Client();
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody(), true);
        $valorMoedaDestino = $data["BRL{$moedaDestino}"]["bid"];

        return (float) $valorMoedaDestino;
    }
}
