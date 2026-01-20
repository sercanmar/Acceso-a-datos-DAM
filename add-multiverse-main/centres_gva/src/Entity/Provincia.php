<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Provincia
 *
 * @ORM\Table(name="provincia")
 * @ORM\Entity
 */
class Provincia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     *
     */
    private $id;

    /**
     * @var string|null
     *
     *
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     * @Groups({"provincia","provincia_nom"})
     */
    private $nom;

    public function getId(): int
    {
        return $this->id;
    }



    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }


}
