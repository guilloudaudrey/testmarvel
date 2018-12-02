<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;


class MarvelApi{

    private $privateKey;
    private $publicKey;
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function fetchAllCharacters(){

        $this->privateKey = $this->container->getParameter('private.key');
        $this->publicKey = $this->container->getParameter('public.key');
        $cache = new FilesystemCache();
        $data = [];


        $ts = time();
        $hash = md5($ts . $this->privateKey . $this->publicKey);


        if (!$cache->has('heroes')) {
            $client = new Client();
            $res = $client->request('GET', 'http://gateway.marvel.com/v1/public/characters?offset=99&ts=' . $ts . '&apikey=' . $this->publicKey . '&hash=' . $hash);
            $response = json_decode($res->getBody(), true);
            $cache->set('heroes', $response);
        } else {
            $response = $cache->get('heroes');
        }



        foreach ($response['data']['results'] as $heros){
            $data[] = ['thumbnail' => $heros['thumbnail']['path'].'.'.$heros['thumbnail']['extension'], 'name' => $heros['name']];
        }

        return $data;
    }

    public function fetchOneCharacter($name){
        $this->privateKey = $this->container->getParameter('private.key');
        $this->publicKey = $this->container->getParameter('public.key');
        $cache = new FilesystemCache();

        $ts = time();
        $hash = md5($ts . $this->privateKey . $this->publicKey);

        if (!$cache->has('hero'.$name)) {
            $client = new Client();
            $res = $client->request('GET', 'http://gateway.marvel.com/v1/public/characters?name=' . $name . '&ts=' . $ts . '&apikey=' . $this->publicKey . '&hash=' . $hash);
            $response = json_decode($res->getBody(), true);
            $cache->set('hero' . $name, $response);
        }else{
            $response = $cache->get('hero' . $name);
        }

        foreach ($response['data']['results'] as $hero){
            $data = $hero;
        }

        return $data;
    }
}