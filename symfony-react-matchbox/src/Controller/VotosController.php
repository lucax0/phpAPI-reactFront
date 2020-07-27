<?php

namespace App\Controller;
    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\DAOController;

class VotosController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('votos/index.html.twig',[
            'controller_name' => 'VotosController',
        ]);
    }

    // /**
    //  * @Route("/api/listvotos", name="listvotos")
    //  * @return \Symfony\Component\HttpFoundation\JsonResponse
    //  */
    // public function getListvotos()
    // {
    //     $listVotos = DAOController::getAll();
        
    //     $response = new Response();

    //     $response->headers->set('Content-Type', 'application/json');
    //     $response->headers->set('Access-Control-Allow-Origin', '*');

    //     $response->setContent(json_encode($listVotos));
        
    //     return $response;
    // }
}