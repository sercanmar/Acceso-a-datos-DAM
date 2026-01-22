<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Affiliations;
use App\Entity\Characters;
use App\Entity\Deaths;
use App\Entity\Films;
use App\Entity\Planets;
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

    public function getCharacter_death(int $episode)
    {
        $deaths = $this->getDoctrine()->getRepository(Deaths::class)->findAll();
        $deaths_filtradas=[];

        foreach ($deaths as $death) {
            if ($death->getId() == $episode) {
                $deaths_filtradas[]=[
                    'death' => $death->getIdCharacter()->getName(),
                    'killer' => $death->getIdKiller()->getName(),
                    'episode' => $death->getIdFilm()->getEpisode(),
                ];
            }
        }

        $data=json_encode($deaths_filtradas);

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function newCharacters(SerializerInterface $serializer): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lista_character = [];
        $film7 = $entityManager
            ->getRepository(Films::class)
            ->findOneBy(['episode' => 'Episode VII']);

        $character1 = new Characters();
        $character1->setName('Rey');
        $character1->setHeight(170);
        $character1->setMass(54);
        $character1->setEyeColor('black');
        $character1->setHairColor('white');
        $character1->setSkinColor('brown');
        $character1->setBirthYear('15DBY');
        $character1->setCreatedDate(new \DateTime());
        $character1->setUpdatedDate(new \DateTime());
        $character1->setGender('female');
        $planeta1 = $this->getDoctrine()
            ->getRepository(Planets::class)
            ->findOneBy(['name' => 'Jakku']);
        $character1->setPlanet($planeta1);
        $character1->addFilm($film7);
        $entityManager->persist($character1);
        $lista_character[] = $character1;


        $character2 = new Characters();
        $character2->setName('Finn');
        $character2->setHeight(178);
        $character2->setMass(73);
        $character2->setEyeColor('black');
        $character2->setHairColor('dark');
        $character2->setSkinColor('dark');
        $character2->setBirthYear('11DBY');
        $character2->setCreatedDate(new \DateTime());
        $character2->setUpdatedDate(new \DateTime());
        $character2->setGender('male');
        $planeta2 = $entityManager
            ->getRepository(Planets::class)
            ->findOneBy(['name' => 'Kamino']);
        $character2->setPlanet($planeta2);
        $character2->addFilm($film7);
        $entityManager->persist($character2);
        $lista_character[] = $character2;



        $character3 = new Characters();
        $character3->setName('Kylo Ren');
        $character3->setHeight(189);
        $character3->setMass(89);
        $character3->setEyeColor('black');
        $character3->setHairColor('white');
        $character3->setSkinColor('brown');
        $character3->setBirthYear('5DBY');
        $character3->setCreatedDate(new \DateTime());
        $character3->setUpdatedDate(new \DateTime());
        $character3->setGender('male');
        $planeta3 = $entityManager
            ->getRepository(Planets::class)
            ->findOneBy(['name' => 'Chandrila']);
        $character3->setPlanet($planeta3);
        $character3->addFilm($film7);
        $entityManager->persist($character3);
        $lista_character[] = $character3;

        $entityManager->flush();
        $jsonEntity = $serializer->serialize(
            $lista_character,
            'json',
            ['groups' => 'characters']
        );

        return new Response($jsonEntity);
    }

}