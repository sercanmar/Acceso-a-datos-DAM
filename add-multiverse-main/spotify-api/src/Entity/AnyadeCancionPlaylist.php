<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AnyadeCancionPlaylist
 *
 * @ORM\Table(name="anyade_cancion_playlist", indexes={@ORM\Index(name="fk_anyade_cancion_playlist_cancion1_idx", columns={"cancion_id"}), @ORM\Index(name="fk_anyade_cancion_playlist_playlist1_idx", columns={"playlist_id"}), @ORM\Index(name="fk_anyade_cancion_playlist_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fecha_anyadida", columns={"fecha_anyadida"})})
 * @ORM\Entity
 */
class AnyadeCancionPlaylist
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anyadida", type="datetime", nullable=false)
     * @Groups({"cancion","playlist"})
     */
    private $fechaAnyadida;

    /**
     * @var Playlist
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Playlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
     * })
     * @Groups({"cancion"})
     */
    private $playlist;

    /**
     * @var Cancion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Cancion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancion_id", referencedColumnName="id")
     * })
     * @Groups({"playlist"})
     */
    private $cancion;

    /**
     * @var Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     * @Groups({"cancion","playlist"})
     */
    private $usuario;

    public function getFechaAnyadida(): \DateTime
    {
        return $this->fechaAnyadida;
    }

    public function setFechaAnyadida(\DateTime $fechaAnyadida): void
    {
        $this->fechaAnyadida = $fechaAnyadida;
    }

    /**
     * @return Playlist
     */
    public function getPlaylist(): Playlist
    {
        return $this->playlist;
    }

    /**
     * @param Playlist $playlist
     */
    public function setPlaylist(Playlist $playlist): void
    {
        $this->playlist = $playlist;
    }

    /**
     * @return Cancion
     */
    public function getCancion(): Cancion
    {
        return $this->cancion;
    }

    /**
     * @param Cancion $cancion
     */
    public function setCancion(Cancion $cancion): void
    {
        $this->cancion = $cancion;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }


}
