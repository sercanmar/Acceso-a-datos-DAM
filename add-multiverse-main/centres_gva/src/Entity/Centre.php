<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Centre
 *
 * @ORM\Table(name="centre", uniqueConstraints={@ORM\UniqueConstraint(name="codi", columns={"codi"})}, indexes={@ORM\Index(name="fk_regim_centre1_idx", columns={"regim_id"}), @ORM\Index(name="fk_provincia_centre1_idx", columns={"provincia_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CentreRepository")
 */
class Centre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({"centre"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codi", type="string", length=8, nullable=false)
     * @Groups({"centre"})
     */
    private $codi = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="centre", type="string", length=150, nullable=true)
     * @Groups({"centre"})
     */
    private $centre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="direccio", type="string", length=200, nullable=true)
     * @Groups({"centre"})
     */
    private $direccio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="localitat", type="string", length=150, nullable=true)
     * @Groups({"centre"})
     */
    private $localitat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefon", type="string", length=12, nullable=true)
     * @Groups({"centre"})
     */
    private $telefon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="query", type="string", length=255, nullable=true)
     * @Groups({"centre"})
     */
    private $query;

    /**
     * @var Provincia
     *
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     * })
     * @Groups({"centre"})
     */
    private $provincia;

    /**
     * @var Regim
     *
     * @ORM\ManyToOne(targetEntity="Regim")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="regim_id", referencedColumnName="id")
     * })
     * @Groups({"centre"})
     */
    private $regim;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cicle", mappedBy="centre")
     *
     */
    private $cicle = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cicle = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCodi(): string
    {
        return $this->codi;
    }

    public function setCodi(string $codi): void
    {
        $this->codi = $codi;
    }

    public function getCentre(): ?string
    {
        return $this->centre;
    }

    public function setCentre(?string $centre): void
    {
        $this->centre = $centre;
    }

    public function getDireccio(): ?string
    {
        return $this->direccio;
    }

    public function setDireccio(?string $direccio): void
    {
        $this->direccio = $direccio;
    }

    public function getLocalitat(): ?string
    {
        return $this->localitat;
    }

    public function setLocalitat(?string $localitat): void
    {
        $this->localitat = $localitat;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(?string $telefon): void
    {
        $this->telefon = $telefon;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): void
    {
        $this->provincia = $provincia;
    }

    public function getRegim(): ?Regim
    {
        return $this->regim;
    }

    public function setRegim(?Regim $regim): void
    {
        $this->regim = $regim;
    }

    public function getCicle()
    {
        return $this->cicle;
    }

    public function setCicle($cicle): void
    {
        $this->cicle = $cicle;
    }

    public function addCicle(Cicle $cicle): void
    {
        if (!$this->cicle->contains($cicle)) {
            $this->cicle[] = $cicle;
        }
    }
}
