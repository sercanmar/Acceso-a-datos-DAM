<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Affiliations;
use App\Entity\Characters;
use App\Entity\Deaths;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CharactersController extends AbstractController
{
    /**
     * @Route("/characters")
     */
    public function all(SerializerInterface $serializer): Response
    {
        // busco todos los personajes
        $characters = $this->getDoctrine()->getRepository(Characters::class)->findAll();

        $data = $serializer->serialize(
            $characters,
            'json',
            ['groups' => 'characters']
        );

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    public function getCharacter(int $id, SerializerInterface $serializer): Response
    {
        $character = $this->getDoctrine()
            ->getRepository(Characters::class)
            ->findOneBy(['id' => $id]);


        $data = $serializer->serialize(
            $character,
            'json',
            ['groups' => 'characters']
        );

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function getCharacter_Order(int $order, SerializerInterface $serializer): Response
    {
        $affiliation = $this->getDoctrine()
            ->getRepository(Affiliations::class)
            ->find(['id' => $order]);
        $character=$affiliation->getCharacters();

        $data = $serializer->serialize(
            $character,
            'json',
            ['groups' => 'characters']
        );

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function getCharacter_death(int $episode, SerializerInterface $serializer): Response
    {
        $death = $this->getDoctrine()
            ->getRepository(Deaths::class)
            ->find(['idFilm' => $episode]);
        $character=$death->getIdCharacter();

        $data = $serializer->serialize(
            $character,
            'json',
            ['groups' => 'characters']
        );

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }


}