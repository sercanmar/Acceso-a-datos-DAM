<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Deaths;
use App\Entity\Films;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FilmsController extends AbstractController
{
    /**
     * @Route("/films")
     */
    public function all(SerializerInterface $serializer): Response
    {
        $films = $this->getDoctrine()->getRepository(Films::class)->findAll();

        $data = $serializer->serialize(
            $films,
            'json',
            ['groups' => 'films']
        );

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    public function getFilm(int $id, SerializerInterface $serializer): Response
    {

        $film = $this->getDoctrine()
            ->getRepository(Films::class)
            ->findOneBy(['id' => $id]);

        $data = $serializer->serialize(
            $film,
            'json',
            ['groups' => 'films']
        );

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function filmsDeaths(){


        $deaths = $this->getDoctrine()->getRepository(Deaths::class)->findAll();
        $films=[];
        foreach($deaths as $death){

            $films[!empty($death->getIdFilm()) ? $death->getIdFilm()->getTitle(): "No film found"][] = [
            'killer' => $death->getIdKiller()->getName(),
                'death' => $death->getIdCharacter()->getName(),
            ];
           // dump($death->getIdFilm()->getTitle())? $death->getIdFilm()->getTitle():"No file";
            //dump($death->getIdKiller()->getName());
          //  dump($death->getIdCharacter()->getName());
        }
        $data = json_encode($films);
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
    public function newFilms(SerializerInterface $serializer): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lista_peliculas = [];

        $film7 = new Films();
        $film7->setEpisode('Episode VII');
        $film7->setTitle('El despertar de la fuerza');
        $entityManager->persist($film7);
        $lista_peliculas[] = $film7;

        $film8 = new Films();
        $film8->setEpisode('Episode VIII');
        $film8->setTitle('Los últimos jedis');
        $entityManager->persist($film8);
        $lista_peliculas[] = $film8;

        $film9 = new Films();
        $film9->setEpisode('Episode IX');
        $film9->setTitle('El ascenso de Skywalker');
        $entityManager->persist($film9);
        $lista_peliculas[] = $film9;



        $entityManager->flush();
        $jsonEntity = $serializer->serialize(
            $lista_peliculas,
            'json',
            ['groups' => 'films']
        );

        return new Response($jsonEntity);
    }


    }
