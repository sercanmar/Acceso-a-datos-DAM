<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Patrocinada
 *
 * @ORM\Table(name="patrocinada", indexes={@ORM\Index(name="fk_patrocinada_playlist1_idx", columns={"playlist_id"})})
 * @ORM\Entity
 */
class Patrocinada
{
    /**
     * @var bool
     *
     * @ORM\Column(name="patrocinada", type="boolean", nullable=false, options={"default"="1"})
     * @Groups({"playlist"})
     */
    private $patrocinada = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     * @Groups({"playlist"})
     */
    private $fechaInicio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     * @Groups({"playlist"})
     */
    private $fechaFin;

    /**
     * @var Playlist
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Playlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
     * })
     * @Groups({"playlist"})
     */
    private $playlist;

    public function isPatrocinada(): bool
    {
        return $this->patrocinada;
    }

    public function setPatrocinada(bool $patrocinada): void
    {
        $this->patrocinada = $patrocinada;
    }

    /**
     * @return \DateTime
     */
    public function getFechaInicio(): \DateTime
    {
        return $this->fechaInicio;
    }

    /**
     * @param \DateTime $fechaInicio
     */
    public function setFechaInicio(\DateTime $fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
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
     * @return \DateTime|null
     */
    public function getFechaFin(): ?\DateTime
    {
        return $this->fechaFin;
    }

    /**
     * @param \DateTime|null $fechaFin
     */
    public function setFechaFin(?\DateTime $fechaFin): void
    {
        $this->fechaFin = $fechaFin;
    }


}
