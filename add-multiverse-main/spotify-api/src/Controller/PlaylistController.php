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

class PlaylistController extends AbstractController
{


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

        $activa = $this->getDoctrine()
            ->getRepository(Activa::class)
            ->findOneBy(['playlist' => $playlist]);
        $eliminada = $this->getDoctrine()
            ->getRepository(Eliminada::class)
            ->findOneBy(['playlist' => $playlist]);
        $patrocinada = $this->getDoctrine()
            ->getRepository(Patrocinada::class)
            ->findOneBy(['playlist' => $playlist]);
        $favoritas = $this->getDoctrine()
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
        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->findOneBy(['id' => $id]);

        if (!$playlist) {
            return new Response("Playlist no encontrada", 404);
        }
        $cancionesplaylist = $this->getDoctrine()
            ->getRepository(AnyadeCancionPlaylist::class)
            ->findBy(['playlist' => $playlist]);


        if ($request->isMethod('GET')) {

            $data = $serializer->serialize($cancionesplaylist, 'json', ['groups' => 'playlist']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);


        }
        if ($request->isMethod('POST')) {

            $data = json_decode($request->getContent(), true);
            $cancionid = $data['cancionId'];
            $usuarioid = $data['usuarioId'];

            $cancion = $this->getDoctrine()
                ->getRepository(Cancion::class)
                ->findOneBy(['id' => $cancionid]);
            $usuario = $this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['id' => $usuarioid]);

            $cancionnueva = new AnyadeCancionPlaylist();
            $cancionnueva->setUsuario($usuario);
            $cancionnueva->setCancion($cancion);
            $cancionnueva->setPlaylist($playlist);
            $cancionnueva->setFechaAnyadida(new \DateTime('today'));

            $entityManager = $this->getDoctrine()
                ->getManager();
            $entityManager->persist($cancionnueva);

            $entityManager->flush();

            $data = $serializer->serialize($cancionnueva, 'json', ['groups' => 'playlist']);
            return new Response($data, 201, ['Content-Type' => 'application/json']);


        }
    }

    
    public function borrar_canciones_playlist(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');
        $cancionid = $request->get('cancionid');
        $entityManager = $this->getDoctrine()->getManager();

        $playlist = $this->getDoctrine()->
        getRepository(Playlist::class)
            ->findOneBy(['id' => $id]);

        $cancion = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->findOneBy(['id' => $cancionid]);
        $cancionaborrar = $this->getDoctrine()
            ->getRepository(AnyadeCancionPlaylist::class)
            ->findOneBy([
                'playlist' => $playlist,
                'cancion' => $cancion
            ]);

        $entityManager->remove($cancionaborrar);

        $entityManager->flush();

        return new Response("borrado", 200);


    }


    public function playlists(Request $request, SerializerInterface $serializer): Response
    {
        


    }

    public function playlist(Request $request, SerializerInterface $serializer): Response
    {
       


    }


    
}