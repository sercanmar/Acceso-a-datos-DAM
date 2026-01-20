<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Deaths;
use App\Entity\Planets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PlanetsController extends AbstractController
{

    /**
     * @Route("/planets")
     */
    public function all(SerializerInterface $serializer): Response
{
    $planets = $this->getDoctrine()->getRepository(Planets::class)->findAll();
    $data = $serializer->serialize(
        $planets,
        'json',
        ['groups' => 'planets']);

    return new Response($data,
        200,
        ['Content-Type' => 'application/json']);
}
    public function getPlanet(int $id, SerializerInterface $serializer): Response{

        $planets = $this->getDoctrine()
            ->getRepository(Planets::class)
            ->findOneBy(['id'=>$id]);

        $data= $serializer->serialize(
            $planets,
            'json',
            ['groups' => 'planets']
        );
        return new Response($data,Response::HTTP_OK,['Content-Type' => 'application/json']);
    }
}
