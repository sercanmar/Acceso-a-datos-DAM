<?php

namespace App\Controller;

use App\Entity\Regim;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class RegimController extends AbstractController
{
    // listar todos
    public function regims(SerializerInterface $serializer): Response
    {
        $regims = $this->getDoctrine()
            ->getRepository(Regim::class)
            ->findAll();

        $json = $serializer->serialize(
            $regims,
            'json',
            ['groups' => ['regim']]
        );

        return new Response($json);
    }

    // ver uno solo
    public function regim($id, SerializerInterface $serializer): Response
    {
        $regim = $this->getDoctrine()
            ->getRepository(Regim::class)
            ->findOneBy(['id' => $id]);

        if (!$regim) {
            return new Response('Regim not found', 404);
        }

        $json = $serializer->serialize(
            $regim,
            'json',
            ['groups' => ['regim']]
        );

        return new Response($json);
    }

    // crear nuevo
    public function newRegim(SerializerInterface $serializer): Response
    {
        $regim = new Regim();
        // dato de prueba
        $regim->setNom('Nuevo Tipo');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($regim);
        $entityManager->flush();

        $json = $serializer->serialize(
            $regim,
            'json',
            ['groups' => ['regim']]
        );

        return new Response($json);
    }

    // editar existente
    public function updateRegim($id, SerializerInterface $serializer): Response
    {
        $regim = $this->getDoctrine()
            ->getRepository(Regim::class)
            ->findOneBy(['id' => $id]);

        if (!empty($regim)) {
            // cambio el nombre
            $regim->setNom('Tipo Editado');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $json = $serializer->serialize(
                $regim,
                'json',
                ['groups' => ['regim']]
            );

            return new Response($json);
        }

        return new Response('Regim not found', 404);
    }

    // borrar
    public function deleteRegim($id): Response
    {
        $regim = $this->getDoctrine()
            ->getRepository(Regim::class)
            ->findOneBy(['id' => $id]);

        if (!empty($regim)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($regim);
            $entityManager->flush();

            return new Response('Regim deleted', 200);
        }

        return new Response('Regim not found', 404);
    }
}