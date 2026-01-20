<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Affiliations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AffiliationsController extends AbstractController
{
    public function all(SerializerInterface $serializer): Response
    {
        $affiliations = $this->getDoctrine()
            ->getRepository(Affiliations::class)
            ->findAll();

        $data = $serializer->serialize(
            $affiliations,
            'json',
            ['groups' => 'affiliations']
        );

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    public function getAffiliation(int $id, SerializerInterface $serializer): Response
    {
        $affiliation = $this->getDoctrine()
            ->getRepository(Affiliations::class)
            ->findOneBy(['id' => $id]);

        $data = $serializer->serialize(
            $affiliation,
            'json',
            ['groups' => 'affiliations']
        );

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}