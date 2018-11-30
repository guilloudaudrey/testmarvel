<?php

namespace AppBundle\Controller;

use AppBundle\Service\ClientMarvel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class HeroesController extends Controller{

    protected $clientMarvel;

    public function __construct(ClientMarvel $clientMarvel)
    {
        $this->clientMarvel = $clientMarvel;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $data = $this->clientMarvel->fetchAllCharacters();
        return $this->render('heroes/index.html.twig', array(
            'data' => $data,
        ));
    }
    /**
     * @Route("/show/{name}", name="show")
     */
    public function showAction($name){

        $data = $this->clientMarvel->fetchOneCharacter($name);
        return $this->render('heroes/show.html.twig', array(
            'data' => $data
        ));

    }
}


