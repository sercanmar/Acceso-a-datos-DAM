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

class SeguirController extends AbstractController
{


     public function playlist_seguidas(Request $request, SerializerInterface $serializer): Response
    {

        $id = $request->get('id');
        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);
        $playlistsSeguidas = $usuario->getPlaylist();
        $data = $serializer->serialize($playlistsSeguidas, 'json', ['groups' => 'playlist']);
        return new Response($data, 200, ['Content-Type' => 'application/json']);

    }

    
    public function seguir_borrar_playlists(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');
        $idplaylist = $request->get('idplaylist');

        $usuario = $this->getDoctrine()->
        getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->findBy(['id' => $idplaylist]);


        if ($request->isMethod('PUT')) {

            $usuario->getPlaylist()->add($playlist);


        }

        if ($request->isMethod('DELETE')) {

        }
        return $serializer->serialize($usuario, 'json', ['groups' => 'playlist']);
    }



    public function artistas_seguidos(Request $request, SerializerInterface $serializer)
    {
              }

    public function seguir_borrar_artistas(Request $request, SerializerInterface $serializer): Response
         {
         }

    public function albums_seguidos(Request $request, SerializerInterface $serializer): Response
         {
         }
    public function seguir_borrar_albums(Request $request, SerializerInterface $serializer): Response
         {
         }
    public function podcasts_seguidos(Request $request, SerializerInterface $serializer): Response
         {
         }
    public function seguir_borrar_podcasts(Request $request, SerializerInterface $serializer): Response
         {
         }



}