<?php

declare(strict_types=1);

namespace App\Controller;

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
}