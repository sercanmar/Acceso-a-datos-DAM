<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Planets
 *
 * @ORM\Table(name="planets")
 * @ORM\Entity
 */
class Planets
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"planets","characters"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=true)
     * @Groups({"planets","characters"})
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rotation_period", type="integer", nullable=true)
     * @Groups({"planets"})
     */
    private $rotationPeriod;

    /**
     * @var int|null
     *
     * @ORM\Column(name="orbital_period", type="integer", nullable=true)
     * @Groups({"planets"})
     */
    private $orbitalPeriod;

    /**
     * @var int|null
     *
     * @ORM\Column(name="diameter", type="integer", nullable=true)
     * @Groups({"planets"})
     */
    private $diameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="climate", type="text", length=65535, nullable=true)
     * @Groups({"planets"})
     */
    private $climate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gravity", type="text", length=65535, nullable=true)
     * @Groups({"planets"})
     */
    private $gravity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="terrain", type="text", length=65535, nullable=true)
     * @Groups({"planets"})
     */
    private $terrain;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surface_water", type="text", length=65535, nullable=true)
     * @Groups({"planets"})
     */
    private $surfaceWater;

    /**
     * @var int|null
     *
     * @ORM\Column(name="population", type="bigint", nullable=true)
     * @Groups({"planets"})
     */
    private $population;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     * @Groups({"planets"})
     */
    private $createdDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     * @Groups({"planets"})
     */
    private $updatedDate = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=true)
     * @Groups({"planets"})
     */
    private $url;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return \DateTime|string|null
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param \DateTime|string|null $updatedDate
     */
    public function setUpdatedDate($updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    /**
     * @return \DateTime|string|null
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime|string|null $createdDate
     */
    public function setCreatedDate($createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(?int $population): void
    {
        $this->population = $population;
    }

    public function getSurfaceWater(): ?string
    {
        return $this->surfaceWater;
    }

    public function setSurfaceWater(?string $surfaceWater): void
    {
        $this->surfaceWater = $surfaceWater;
    }

    public function getGravity(): ?string
    {
        return $this->gravity;
    }

    public function setGravity(?string $gravity): void
    {
        $this->gravity = $gravity;
    }

    public function getTerrain(): ?string
    {
        return $this->terrain;
    }

    public function setTerrain(?string $terrain): void
    {
        $this->terrain = $terrain;
    }

    public function getClimate(): ?string
    {
        return $this->climate;
    }

    public function setClimate(?string $climate): void
    {
        $this->climate = $climate;
    }

    public function getOrbitalPeriod(): ?int
    {
        return $this->orbitalPeriod;
    }

    public function setOrbitalPeriod(?int $orbitalPeriod): void
    {
        $this->orbitalPeriod = $orbitalPeriod;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): void
    {
        $this->diameter = $diameter;
    }

    public function getRotationPeriod(): ?int
    {
        return $this->rotationPeriod;
    }

    public function setRotationPeriod(?int $rotationPeriod): void
    {
        $this->rotationPeriod = $rotationPeriod;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }


}
