<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Deaths
 *
 * @ORM\Table(name="deaths", indexes={@ORM\Index(name="id_character", columns={"id_character"}), @ORM\Index(name="id_killer", columns={"id_killer"}), @ORM\Index(name="id_film", columns={"id_film"})})
 * @ORM\Entity
 */
class Deaths
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"deaths","characters"})
     */
    private $id;

    /**
     * @var Characters
     *
     * @ORM\ManyToOne(targetEntity="Characters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_character", referencedColumnName="id")
     * })
     * @Groups({"deaths"})
     */
    private $idCharacter;

    /**
     * @var Characters
     *
     * @ORM\ManyToOne(targetEntity="Characters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_killer", referencedColumnName="id")
     * })
     * @Groups({"deaths"})
     */
    private $idKiller;

    /**
     * @var Films
     *
     * @ORM\ManyToOne(targetEntity="Films")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_film", referencedColumnName="id")
     * })
     * @Groups({"deaths"})
     */
    private $idFilm;

    public function getIdFilm(): ?Films
    {
        return $this->idFilm;
    }

    public function setIdFilm(Films $idFilm): void
    {
        $this->idFilm = $idFilm;
    }

    public function getIdKiller(): Characters
    {
        return $this->idKiller;
    }

    public function setIdKiller(Characters $idKiller): void
    {
        $this->idKiller = $idKiller;
    }

    public function getIdCharacter(): Characters
    {
        return $this->idCharacter;
    }

    public function setIdCharacter(Characters $idCharacter): void
    {
        $this->idCharacter = $idCharacter;
    }

    public function getId(): int
    {
        return $this->id;
    }



}
