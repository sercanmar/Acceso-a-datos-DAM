<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// importo esto para poder usar los grupos
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Regim
 *
 * @ORM\Table(name="regim")
 * @ORM\Entity
 * @Groups({"regim","cicle_centre"})
 */
class Regim
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"regim","cicle_centre"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=10, nullable=true)
     * @Groups({"regim","cicle_centre"})
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