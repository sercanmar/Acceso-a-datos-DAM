<?php

namespace App\Controller;


use App\Entity\Activa;
use App\Entity\Calidad;
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

class UsuarioController extends AbstractController
{


    public function usuarios(Request $request, SerializerInterface $serializer)
    {
        if ($request->isMethod('GET')) {
            $usuarios = $this->getDoctrine()->
            getRepository(Usuario::class)
                ->findAll();
            $data = $serializer->serialize($usuarios, 'json', ['groups' => 'usuario']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);

        }
        if ($request->isMethod('POST')) {

            //leemos query parameter
            $premium = $request->request->get('premium');

            //leer usuario del body
            $data = $request->getContent();
            $usuario = $serializer->deserialize
            ($data, Usuario::class, 'json', ['groups' => 'usuario:write']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            //dependiendo del tipo de usuario, creamos free o premium
            if ($premium) {
                $premium = new Premium();
                $premium->setUsuario($usuario);
                $proximaRenovacion = (new \DateTime('today'))->modify('+1 month');
                $premium->setFechaRenovacion($proximaRenovacion);
                $entityManager->persist($premium);
            } else {
                $free = new Free();
                $free->setUsuario($usuario);
                $fecharevision = (new \DateTime('today'))->modify('+1 month');
                $free->setFechaRevision($fecharevision);
                $entityManager->persist($free);


            }
            //creamos config por defecto
            $configuracion = new Configuracion();
            $configuracion->setUsuario($usuario);
            $configuracion->setAutoplay(true);
            $configuracion->setNormalizacion(true);
            $configuracion->setAjuste(true);

            $calidad = $entityManager->getRepository(Calidad::class)->findOneBy(['id' => 1]);
            $idioma = $entityManager->getRepository(Idioma::class)->findOneBy(['id' => 1]);
            $tipodescarga = $entityManager->getRepository(Tipodescarga::class)->findOneBy(['id' => 1]);
            $configuracion->setIdioma($idioma);
            $configuracion->setTipodescarga($tipodescarga);
            $configuracion->setCalidad($calidad);

            $entityManager->persist($configuracion);
            $entityManager->flush();

            $data = $serializer->serialize($usuario, 'json', ['groups' => 'usuario:read']);
            return new Response($data, 201, ['Content-Type' => 'application/json']);


        }
        return new Response("Not allowed", 405);

    }


    public function usuario(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);


        if ($request->isMethod('GET')) {
            $data = $serializer->serialize($usuario, 'json', ['groups' => 'usuario:read']);

            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }
        if ($request->isMethod('PUT')) {
            $data = $request->getContent();
            $serializer->deserialize($data, Usuario::class, 'json', [
                'groups' => 'usuario:read',
                'object_to_populate' => $usuario
            ]);

            $this->getDoctrine()->getManager()->flush();
            $data = $serializer->serialize($usuario, 'json', ['groups' => 'usuario']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }

        if ($request->isMethod('DELETE')) {
            $entityManager = $this->getDoctrine()->getManager();

            $configuracion = $this->getDoctrine()
                ->getRepository(Configuracion::class)
                ->findOneBy(['usuario' => $usuario]);

            $premium = $this->getDoctrine()
                ->getRepository(Premium::class)
                ->findOneBy(['usuario' => $usuario]);

            $free = $this->getDoctrine()
                ->getRepository(Free::class)
                ->findOneBy(['usuario' => $usuario]);

            if ($premium) {

                $entityManager->remove($premium);
            }
            if ($free) {
                $entityManager->remove($free);
            }
            if ($configuracion) {
                $entityManager->remove($configuracion);
            }


            $entityManager->remove($usuario);
            $entityManager->flush();

            return new Response("borrado", 200);


        }


    }

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

    public function configuracion_usuario(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        $configuracion = $this->getDoctrine()
            ->getRepository(Configuracion::class)
            ->findOneBy(['usuario' => $usuario]);


        if ($request->isMethod('GET')) {
            $data = $serializer->serialize($configuracion, 'json', ['groups' => 'configuracion']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }
        if ($request->isMethod('PUT')) {
           // $calidad = $configuracion->getCalidad();
            //$tipoDescarga = $configuracion->getTipoDescarga();
          //  $idioma = $configuracion->getIdioma();

            $data = $request->getContent();
            $serializer->deserialize($data, Configuracion::class, 'json', [
                'groups' => 'configuracion',
                'object_to_populate' => $configuracion
            ]);

            $this->getDoctrine()->getManager()->flush();
            $data = $serializer->serialize($configuracion, 'json', ['groups' => 'configuracion']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);
                //falta insertar en subtablas
        }


    }


    public function playlist_usuario(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findBy(['id' => $id]);

        $playlists = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->findBy(['usuario' => $usuario]);


        if ($request->isMethod('GET')) {
            $data = $serializer->serialize($playlists, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }
        if ($request->isMethod('POST')) {


            $id = $request->get('id');
            $usuario = $this->getDoctrine()->
            getRepository(Usuario::class)
                ->findOneBy(['id' => $id]);

            $data = $request->getContent();

            $playlistnueva = $serializer->deserialize
            ($data, Playlist::class, 'json', ['groups' => 'playlist']);


            $playlistnueva->setUsuario($usuario);
            $playlistnueva->setFechaCreacion(new \DateTime('today'));


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playlistnueva);

            $entityManager->flush();

            $data = $serializer->serialize($playlistnueva, 'json', ['groups' => 'playlist']);
            return new Response($data, 201, ['Content-Type' => 'application/json']);



        }


}
    public function detalles_playlist(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get('id');
        $playlist = $this->getDoctrine()->
        getRepository(Playlist::class)
            ->findOneBy(['id' => $id]);
        if (!$playlist) {
            return new Response("Playlist no encontrada", 404);
        }

        $activa=$this->getDoctrine()
            ->getRepository(Activa::class)
            ->findOneBy(['playlist' => $playlist]);
        $eliminada=$this->getDoctrine()
            ->getRepository(Eliminada::class)
            ->findOneBy(['playlist' => $playlist]);
        $patrocinada=$this->getDoctrine()
            ->getRepository(Patrocinada::class)
            ->findOneBy(['playlist' => $playlist]);
        $favoritas=$this->getDoctrine()
            ->getRepository(Favoritas::class)
            ->findOneBy(['playlist' => $playlist]);



        if ($activa && $activa->isEsCompartida()) {

            $data = $serializer->serialize($activa, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        if ($eliminada && $eliminada->getFechaEliminacion()) {

            $data = $serializer->serialize($eliminada, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        if ($patrocinada && $patrocinada->isPatrocinada()) {
            $data = $serializer->serialize($patrocinada, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        if ($favoritas && $favoritas->getPlaylist()) {
            $data = $serializer->serialize($favoritas, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        $data = $serializer->serialize($playlist, 'json', ['groups' => 'playlist']);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    public function canciones_playlist(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get('id');
        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findBy(['id' => $id]);

        $playlists = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->findBy(['usuario' => $usuario]);


        if ($request->isMethod('GET')) {
            $data = $serializer->serialize($playlists, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }
        if ($request->isMethod('POST')) {


            $id = $request->get('id');
            $usuario = $this->getDoctrine()->
            getRepository(Usuario::class)
                ->findOneBy(['id' => $id]);

            $data = $request->getContent();

            $playlistnueva = $serializer->deserialize
            ($data, Playlist::class, 'json', ['groups' => 'playlist']);


            $playlistnueva->setUsuario($usuario);
            $playlistnueva->setFechaCreacion(new \DateTime('today'));


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playlistnueva);

            $entityManager->flush();

            $data = $serializer->serialize($playlistnueva, 'json', ['groups' => 'playlist']);
            return new Response($data, 201, ['Content-Type' => 'application/json']);



        }
    }

    public function borrar_playlist($cancionid, $id)
    {
    }



}