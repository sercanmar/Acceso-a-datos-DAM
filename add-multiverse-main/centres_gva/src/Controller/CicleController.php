<?php

namespace App\Controller;

use App\Entity\Cicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CicleController extends AbstractController
{
    // listar todos
    public function cicles(SerializerInterface $serializer): Response
    {
        $cicles = $this->getDoctrine()
            ->getRepository(Cicle::class)
            ->findAll();

        $json = $serializer->serialize(
            $cicles,
            'json',
            ['groups' => ['cicle','centre']]
        );

        return new Response($json);
    }

    // ver uno solo
    public function cicle($id, SerializerInterface $serializer): Response
    {
        $cicle = $this->getDoctrine()
            ->getRepository(Cicle::class)
            ->findOneBy(['id' => $id]);

        if (!$cicle) {
            return new Response('Cicle not found', 404);
        }

        $json = $serializer->serialize(
            $cicle,
            'json',
            ['groups' => ['cicle', 'centre']]
        );

        return new Response($json);
    }

    // crear nuevo hardcodeado
    public function newCicle(SerializerInterface $serializer): Response
    {
        $cicle = new Cicle();
        // datos de prueba
        $cicle->setCodi('TEST');
        $cicle->setNom('Ciclo de Prueba');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cicle);
        $entityManager->flush();

        $json = $serializer->serialize(
            $cicle,
            'json',
            ['groups' => ['cicle']]
        );

        return new Response($json);
    }

    // editar existente
    public function updateCicle($id, SerializerInterface $serializer): Response
    {
        $cicle = $this->getDoctrine()
            ->getRepository(Cicle::class)
            ->findOneBy(['id' => $id]);

        if (!empty($cicle)) {
            // cambio el nombre
            $cicle->setNom('Ciclo Editado');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $json = $serializer->serialize(
                $cicle,
                'json',
                ['groups' => ['cicle']]
            );

            return new Response($json);
        }

        return new Response('Cicle not found', 404);
    }

    // borrar
    public function deleteCicle($id): Response
    {
        $cicle = $this->getDoctrine()
            ->getRepository(Cicle::class)
            ->findOneBy(['id' => $id]);

        if (!empty($cicle)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cicle);
            $entityManager->flush();

            return new Response('Cicle deleted', 200);
        }

        return new Response('Cicle not found', 404);
    }
}