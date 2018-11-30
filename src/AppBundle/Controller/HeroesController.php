<?php

namespace AppBundle\Controller;

use AppBundle\Service\MarvelApi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class HeroesController extends Controller{

    protected $marvelApi;

    public function __construct(MarvelApi $marvelApi)
    {
        $this->marvelApi = $marvelApi;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $data = $this->marvelApi->fetchAllCharacters();
        return $this->render('heroes/index.html.twig', array(
            'data' => $data,
        ));
    }
    /**
     * @Route("/show/{name}", name="show")
     */
    public function showAction($name){

        $data = $this->marvelApi->fetchOneCharacter($name);
        return $this->render('heroes/show.html.twig', array(
            'data' => $data
        ));

    }
}


