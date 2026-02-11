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

class ArtistaController extends AbstractController



{
    public function artistas(Request $request, SerializerInterface $serializer): Response
    {

    }
    public function artista(Request $request, SerializerInterface $serializer): Response
    {
 
    }
    public function albums_artista(Request $request, SerializerInterface $serializer): Response
    {

    }
    public function canciones_artista(Request $request, SerializerInterface $serializer): Response
    {
    


    }






}