<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TmdbService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        // Crée une instance du client Guzzle
        $this->client = new Client();
        // Remplace par ta clé API TMDB
        $this->apiKey = env('TMDB_API_KEY'); // Assurez-vous que la clé est dans votre .env
    }

    public function getGenres()
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/genre/movie/list?language=fr-FR&api_key=$this->apiKey", [
            'headers' => [
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true); // json_decode()

        return $data['genres'];
    }

    public function getFilmById($id)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/$id?append_to_response=credits,videos&language=fr-FR&api_key=$this->apiKey", [
            'headers' => [
                'accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true); // json_decode()

        return $data;
    }
}