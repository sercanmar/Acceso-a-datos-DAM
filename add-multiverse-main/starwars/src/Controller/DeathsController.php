<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\Deaths;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DeathsController extends AbstractController
{

    /**
     * @Route("/deaths")
     */
    public function all(SerializerInterface $serializer): Response
    {
        $deaths = $this->getDoctrine()->getRepository(Deaths::class)->findAll();
        $data = $serializer->serialize(
            $deaths,
            'json',
            ['groups' => 'deaths']);

        return new Response($data,
            200,
            ['Content-Type' => 'application/json']);
    }
    public function getDeath(int $id, SerializerInterface $serializer): Response{

        $deaths = $this->getDoctrine()
            ->getRepository(Deaths::class)
            ->findOneBy(['id'=>$id]);

        $data= $serializer->serialize(
            $deaths,
            'json',
            ['groups' => 'deaths']
        );
        return new Response($data,Response::HTTP_OK,['Content-Type' => 'application/json']);
    }
}
