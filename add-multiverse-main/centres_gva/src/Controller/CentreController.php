<?php

namespace App\Controller;

use App\Entity\Provincia;
use App\Entity\Regim;
use App\Entity\Cicle;
use App\Entity\Centre;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CentreController extends AbstractController
{
    // listar todos
    public function centres(SerializerInterface $serializer): Response
    {
        $centres = $this->getDoctrine()
            ->getRepository(Centre::class)
            ->findAll();

        $centres = $serializer->serialize(
            $centres,
            'json',
            ['groups' => ['centre','provincia','regim']]
        );
        return new Response($centres);
    }

    // listar solo valencia
    public function centresValencia(SerializerInterface $serializer): Response
    {
        $centres = $this->getDoctrine()
            ->getRepository(Centre::class)
            ->findBy(['localitat' => 'Valencia']);

        $centres = $serializer->serialize(
            $centres,
            'json',
            ['groups' => ['centre','provincia','regim']]
        );
        return new Response($centres);
    }

    // ver uno por id
    public function centre($id, SerializerInterface $serializer): Response
    {
        $centre = $this->getDoctrine()
            ->getRepository(Centre::class)
            ->findOneBy(['id' => $id]);

        $json = $serializer->serialize(
            $centre,
            'json',
            ['groups' => ['centre', 'provincia', 'regim']]
        );

        return new Response($json);
    }

    // crear nuevo
    public function newCentre(SerializerInterface $serializer)
    {
        $centre = new Centre();
        $centre->setCodi('1234567');
        $centre->setCentre('Centre Nou');
        $centre->setDireccio('Centre Nou');
        $centre->setLocalitat('Localitat Nova');
        $centre->setTelefon('123456789');

        $provincia = $this->getDoctrine()
            ->getRepository(Provincia::class)
            ->findOneBy(['id' => 1]);
        $centre->setProvincia($provincia);

        $regim = $this->getDoctrine()
            ->getRepository(Regim::class)
            ->findOneBy(['id' => 1]);
        $centre->setRegim($regim);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($centre);
        $entityManager->flush();

        $jsonEntity = $serializer->serialize(
            $centre,
            'json',
            ['groups' => ['centre', 'provincia', 'regim']]
        );

        return new Response($jsonEntity);
    }

    // editar existente
    public function updateCentre($id, SerializerInterface $serializer): Response
    {
        $centre = $this->getDoctrine()
            ->getRepository(Centre::class)
            ->findOneBy(['id' => $id]);

        if (!empty($centre)) {

            $centre->setDireccio('Carrer Nou, 1');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $centre = $serializer->serialize(
                $centre,
                'json',
                ['groups' => ['centre', 'provincia', 'regim']]
            );

            return new Response($centre);
        }

        return new Response('Centre not found', 404);
    }

    // relacionar centro y ciclo
    public function addCicleCentre($centreId, $cicleId, SerializerInterface $serializer): Response
    {
        $cicle = $this->getDoctrine()->getRepository(Cicle::class)->findOneBy(['id' => $cicleId]);
        $centre = $this->getDoctrine()->getRepository(Centre::class)->findOneBy(['id' => $centreId]);

        if (!empty($centre) && !empty($cicle)) {
            $centre->addCicle($cicle);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centre);
            $entityManager->flush();

            $centre = $serializer->serialize($centre, 'json', ['groups' => ['centre', 'provincia', 'regim','cicle']]);
            return new Response($centre);
        }

        return new Response();
    }

    // borrar centro
    public function deleteCentre($id): Response
    {
        $centre = $this->getDoctrine()
            ->getRepository(Centre::class)
            ->findOneBy(['id' => $id]);

        if (!empty($centre)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($centre);
            $entityManager->flush();

            return new Response('Centre deleted', 200);
        }

        return new Response('Centre not found', 404);
    }
    public function centresProvincia(Request $request,SerializerInterface $serializer): Response
    {
        $centres = $this->getDoctrine()
            ->getRepository(Centre::class)
            ->findCentreByProvincia("Prov. de València");

        $centres=json_encode($centres);
        return new Response($centres);


    }
}