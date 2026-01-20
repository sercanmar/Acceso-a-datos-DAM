<?php

namespace App\Controller;

use App\Entity\Provincia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
// uso la ruta si la necesitas por anotaciones, sino se puede quitar
use Symfony\Component\Routing\Annotation\Route;

class ProvinciaController extends AbstractController
{
    /**
     * @Route("/provincias")
     */
    public function provincias(SerializerInterface $serializer): Response
    {
        $provincias = $this->getDoctrine()
            ->getRepository(Provincia::class)
            ->findAll();

        $json = $serializer->serialize(
            $provincias,
            'json',
            ['groups' => ['provincia']]
        );

        return new Response($json);
    }

    // ver una provincia
    public function provincia($id, SerializerInterface $serializer): Response
    {
        $provincia = $this->getDoctrine()
            ->getRepository(Provincia::class)
            ->findOneBy(['id' => $id]);

        if (!$provincia) {
            return new Response('Provincia not found', 404);
        }

        $json = $serializer->serialize(
            $provincia,
            'json',
            ['groups' => ['provincia']]
        );

        return new Response($json);
    }

    // crear nueva provincia hardcodeada
    public function newProvincia(SerializerInterface $serializer): Response
    {
        $provincia = new Provincia();
        // pongo nombre de prueba
        $provincia->setNom('Nueva Provincia');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($provincia);
        $entityManager->flush();

        $json = $serializer->serialize(
            $provincia,
            'json',
            ['groups' => ['provincia']]
        );

        return new Response($json);
    }

    // editar existente
    public function updateProvincia($id, SerializerInterface $serializer): Response
    {
        $provincia = $this->getDoctrine()
            ->getRepository(Provincia::class)
            ->findOneBy(['id' => $id]);

        if (!empty($provincia)) {
            // cambio el nombre
            $provincia->setNom('Provincia Editada');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $json = $serializer->serialize(
                $provincia,
                'json',
                ['groups' => ['provincia']]
            );

            return new Response($json);
        }

        return new Response('Provincia not found', 404);
    }

    // borrar provincia
    public function deleteProvincia($id): Response
    {
        $provincia = $this->getDoctrine()
            ->getRepository(Provincia::class)
            ->findOneBy(['id' => $id]);

        if (!empty($provincia)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($provincia);
            $entityManager->flush();

            return new Response('Provincia deleted', 200);
        }

        return new Response('Provincia not found', 404);
    }
}