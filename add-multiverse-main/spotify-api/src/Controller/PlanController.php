<?php

namespace App\Controller;


use App\Entity\Activa;
use App\Entity\AnyadeCancionPlaylist;
use App\Entity\Calidad;
use App\Entity\Cancion;
use App\Entity\Configuracion;
use App\Entity\Eliminada;
use App\Entity\Favoritas;
use App\Entity\FormaPago;
use App\Entity\Free;
use App\Entity\Idioma;
use App\Entity\Pago;
use App\Entity\Patrocinada;
use App\Entity\Playlist;
use App\Entity\Premium;
use App\Entity\Suscripcion;
use App\Entity\TipoDescarga;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class PlanController extends AbstractController
{
   
   
   public function plan_usuario(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        $free = $this->getDoctrine()
            ->getRepository(Free::class)
            ->findOneBy(['usuario' => $usuario->getId()]);

        $premium = $this->getDoctrine()
            ->getRepository(Premium::class)
            ->findOneBy(['usuario' => $usuario->getId()]);

        if ($premium) {
            $data = $serializer->serialize($premium, 'json', ['groups' => 'usuario:read']);
            print("Es PREMIUM");
            return new Response($data, 200, ['Content-Type' => 'application/json']);

        } elseif ($free) {
            print("Es FREE");
            $data = $serializer->serialize($free, 'json', ['groups' => 'usuario:read']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);

        }
        return new Response("Usuario sin plan asignado", 404);

    }


    public function activar_premium(Request $request, SerializerInterface $serializer)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $usuario = $entityManager->getRepository(Usuario::class)->find($id);

        if (!$usuario) {
            return new Response("Usuario no existo", 404);
        }
        $yaEsPremium = $entityManager->getRepository(Premium::class)
            ->findOneBy(['usuario' => $usuario]);

        if (!$yaEsPremium) {

            $esFree = $entityManager->getRepository(Free::class)
                ->findOneBy(['usuario' => $usuario]);

            if ($esFree) {
                $entityManager->remove($esFree);
            }
            $premium = new Premium();
            $premium->setUsuario($usuario);
            $proximaRenovacion = (new \DateTime('today'))->modify('+1 month');
            $premium->setFechaRenovacion($proximaRenovacion);

            $suscripcion = new Suscripcion();
            $suscripcion->setPremiumUsuario($premium);
            $suscripcion->setFechaInicio((new \DateTime('today')));
            $suscripcion->setFechaFin($proximaRenovacion);

            $formapago = $entityManager->getRepository(Formapago::class)->findOneBy(['id' => 1]);

            $pago = new Pago();
            $pago->setFormaPago($formapago);
            $pago->setFecha((new \DateTime('today')));
            $pago->setTotal(9.99);
            $pago->setSuscripcion($suscripcion);

            $entityManager->persist($pago);
            $entityManager->persist($premium);
            $entityManager->persist($suscripcion);
            $entityManager->flush();

        }

        return new Response("Usuario actualizado a Premium correctamente y suscripcion creada", 200);
    }


    public function pago_usuario(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        $premium = $this->getDoctrine()
            ->getRepository(Premium::class)
            ->findOneBy(['usuario' => $usuario->getId()]);


        if ($premium) {
            $suscipcion = $this->getDoctrine()
                ->getRepository(Suscripcion::class)
                ->findOneBy(['premiumUsuario' => $premium]);

            if ($suscipcion) {
                $pagos = $this->getDoctrine()
                    ->getRepository(Pago::class)
                    ->findBy(['suscripcion' => $suscipcion->getId()]);
                if ($pagos) {
                    $data = $serializer->serialize($pagos, 'json', ['groups' => 'usuario:read']);
                    print("Es PREMIUM");
                    return new Response($data, 200, ['Content-Type' => 'application/json']);

                }
                return new Response("Usuario sin pagos", 404);
            }
            return new Response("Usuario sin suscripcion", 404);

        }
        return new Response("Usuario sin premium", 404);


    }


    public function suscripcion_usuario(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        $premium = $this->getDoctrine()
            ->getRepository(Premium::class)
            ->findOneBy(['usuario' => $usuario->getId()]);


        if ($premium) {
            $suscipcion = $this->getDoctrine()
                ->getRepository(Suscripcion::class)
                ->findOneBy(['premiumUsuario' => $premium]);
            $data = $serializer->serialize($suscipcion, 'json', ['groups' => 'usuario:read']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }
        return new Response("Usuario sin premium", 404);


    }


    
    }