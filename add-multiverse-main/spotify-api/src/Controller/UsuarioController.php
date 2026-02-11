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








}
