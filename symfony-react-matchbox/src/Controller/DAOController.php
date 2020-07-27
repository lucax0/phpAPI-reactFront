<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Votos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DAOController extends AbstractController
{
    /**
     * @Route("/api/dao", name="dao")
     */
    public function seedVotos()
    {
        // COLOCAR EM JSON EXTERNO!!! ---> MODELO SOMENTE PARA TESTES 
        $seedData = [
            [
                "__id" => "f8c3500f39017602234a031caa64a8b4",
                "name" => "Caio Diego Henrique Moreira",
                "description" => "Product Designer",
                "picture" => "https://storage-matchboxbrasil.sfo2.digitaloceanspaces.com/diversos/frontend-test/f8c3500f39017602234a031caa64a8b4.png",
                "positive" => 51638022,
                "negative" => 18143089
            ],
            [
                "__id" => "7b1dd3f58be97715e9e06475bb58fce5",
                "name" => "Isabella Esther Carolina da Mata",
                "description" => "Marketing",
                "picture" => "https://storage-matchboxbrasil.sfo2.digitaloceanspaces.com/diversos/frontend-test/7b1dd3f58be97715e9e06475bb58fce5.png",
                "positive" => 23249923,
                "negative" => 39587707
            ],
            [
                "__id" => "70580002438b08c63286d08b7c43fb4c",
                "name" => "Alessandra Teresinha Fernandes",
                "description" => "Recruitment Marketing",
                "picture" => "https://storage-matchboxbrasil.sfo2.digitaloceanspaces.com/diversos/frontend-test/70580002438b08c63286d08b7c43fb4c.png",
                "positive" => 59089056,
                "negative" => 14772265
            ],
            [
                "__id" => "3404c4a70e7704009cd1915a349189f4",
                "name" => "Emilly Olivia das Neves",
                "description" => "Comunication",
                "picture" => "https://storage-matchboxbrasil.sfo2.digitaloceanspaces.com/diversos/frontend-test/3404c4a70e7704009cd1915a349189f4.png",
                "positive" => 0,
                "negative" => 32
            ],
            [
                "__id" => "c97686edbeb8df774a567e9884f4d490",
                "name" => "Kevin Ruan Cauê Corte Real",
                "description" => "Data Scientist",
                "picture" => "https://storage-matchboxbrasil.sfo2.digitaloceanspaces.com/diversos/frontend-test/c97686edbeb8df774a567e9884f4d490.png",
                "positive" => 69274684,
                "negative" => 9446548
            ]
        ];
        // COLOCAR EM JSON EXTERNO PARA DEIXAR O CODIGO MAIS ESCALAVEL!!! ---> MODELO SOMENTE PARA TESTES         
        try { // Salvando tds os objetos ja pre definidos
            foreach ($seedData as $key => $value) {

                $entityManager = $this->getDoctrine()->getManager();

                $user = new Votos();
                $user->setId($value['__id']);
                $user->setName($value['name']);
                $user->setDescription($value['description']);
                $user->setPicture($value['picture']);
                $user->setPositive($value['positive']);
                $user->setNegative($value['negative']);
                //Setando as infos no OBJT
                $entityManager->persist($user);

                $entityManager->flush();
            }
            $response = new Response();

            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');

            $response->setContent(json_encode([["description" => 'Sucesso ao salvar os items dentro do DB']]));

            return $response;
        } catch (\Throwable $th) {
            throw $th;
            $response = new Response();

            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setContent(json_encode([["description" => 'ERRO AO ACESSAR DB' + $th]]));

            return $response;
        }
    }

    /**
    * @Route("/api/listvotos", name="users_show")
    */
    public function getAll(){
        $arr = [];

        $repository = $this->getDoctrine()->getRepository(Votos::class);

        $listVotos =  $repository->findAll();

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        foreach ($listVotos as $key => $value) {
            # code...
            array_push($arr,$value ->getData());
        }

        $response->setContent(json_encode($arr));      
        return $response;
    }
}
