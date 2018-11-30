<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;


class ClientMarvel{

    private $privateKey = 'd037ab9cd47bcd809f2fcfd847fd5aabc3431403';
    private $publicKey = 'fa4ac958e92065cce575686b21c83361';


    public function fetchAllCharacters(){
        $ts = time();
        $hash = md5($ts . $this->privateKey . $this->publicKey);

        $client = new Client();
        $res = $client->request('GET', 'http://gateway.marvel.com/v1/public/characters?offset=99&ts='.$ts.'&apikey=fa4ac958e92065cce575686b21c83361&hash='.$hash);

        $response = json_decode($res->getBody(), true);
        $data = [];

        foreach ($response['data']['results'] as $heros){
            $data[] = ['thumbnail' => $heros['thumbnail']['path'].'.'.$heros['thumbnail']['extension'], 'name' => $heros['name']];
        }

        return $data;
    }

    public function fetchOneCharacter($name){
        $ts = time();
        $hash = md5($ts . $this->privateKey . $this->publicKey);

        $client = new Client();
        $res = $client->request('GET', 'http://gateway.marvel.com/v1/public/characters?name='.$name.'&ts='.$ts.'&apikey=fa4ac958e92065cce575686b21c83361&hash='.$hash);

        $response = json_decode($res->getBody(), true);

        foreach ($response['data']['results'] as $heros){
            $data = $heros;
        }

        return $data;
    }
}