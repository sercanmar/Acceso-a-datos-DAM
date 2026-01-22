<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Characters
 * @ORM\Table(name="characters")
 * @ORM\Entity
 */
class Characters
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"characters", "films", "affiliations","deaths"})
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="text", nullable=true)
     * @Groups({"characters", "films", "affiliations","deaths"})
     */
    private $name;

    /**
     * @ORM\Column(name="height", type="integer", nullable=true)
     * @Groups({"characters"})
     */
    private $height;

    /**
     * @ORM\Column(name="mass", type="float", nullable=true)
     * @Groups({"characters"})
     */
    private $mass;

    /**
     * @ORM\Column(name="hair_color", type="text", nullable=true)
     * @Groups({"characters"})
     */
    private $hairColor;

    /**
     * @ORM\Column(name="skin_color", type="text", nullable=true)
     * @Groups({"characters"})
     */
    private $skinColor;

    /**
     * @ORM\Column(name="eye_color", type="text", nullable=true)
     * @Groups({"characters"})
     */
    private $eyeColor;

    /**
     * @ORM\Column(name="birth_year", type="text", nullable=true)
     * @Groups({"characters"})
     */
    private $birthYear;

    /**
     * @ORM\Column(name="gender", type="text", nullable=true)
     * @Groups({"characters"})
     */
    private $gender;

    /**
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     * @Groups({"characters"})
     */
    private $createdDate;

    /**
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     * @Groups({"characters"})
     */
    private $updatedDate;

    /**
     * @ORM\Column(name="url", type="text", nullable=true)
     * @Groups({"characters"})
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Planets")
     * @ORM\JoinColumn(name="planet_id", referencedColumnName="id")
     * @Groups({"characters"})
     */
    private $planet;

    /**
     * @ORM\ManyToMany(targetEntity="Affiliations", inversedBy="characters")
     * @ORM\JoinTable(name="character_affiliations",
     * joinColumns={@ORM\JoinColumn(name="id_character", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_affiliation", referencedColumnName="id")}
     * )
     * @Groups({"characters"})
     */
    private $affiliations;

    /**
     * @ORM\ManyToMany(targetEntity="Films", inversedBy="characters")
     * @ORM\JoinTable(name="character_films",
     * joinColumns={@ORM\JoinColumn(name="id_character", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_film", referencedColumnName="id")}
     * )
     * @Groups({"characters"})
     */
    private $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->affiliations = new ArrayCollection();

    }

    // getters y setters

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): void { $this->name = $name; }

    public function getHeight(): ?int { return $this->height; }
    public function setHeight(?int $height): void { $this->height = $height; }

    public function getMass(): ?float { return $this->mass; }
    public function setMass(?float $mass): void { $this->mass = $mass; }

    public function getHairColor(): ?string { return $this->hairColor; }
    public function setHairColor(?string $hairColor): void { $this->hairColor = $hairColor; }

    public function getSkinColor(): ?string { return $this->skinColor; }
    public function setSkinColor(?string $skinColor): void { $this->skinColor = $skinColor; }

    public function getEyeColor(): ?string { return $this->eyeColor; }
    public function setEyeColor(?string $eyeColor): void { $this->eyeColor = $eyeColor; }

    public function getBirthYear(): ?string { return $this->birthYear; }
    public function setBirthYear(?string $birthYear): void { $this->birthYear = $birthYear; }

    public function getGender(): ?string { return $this->gender; }
    public function setGender(?string $gender): void { $this->gender = $gender; }

    public function getCreatedDate(): ?\DateTimeInterface { return $this->createdDate; }
    public function setCreatedDate(?\DateTimeInterface $createdDate): void { $this->createdDate = $createdDate; }

    public function getUpdatedDate(): ?\DateTimeInterface { return $this->updatedDate; }
    public function setUpdatedDate(?\DateTimeInterface $updatedDate): void { $this->updatedDate = $updatedDate; }

    public function getUrl(): ?string { return $this->url; }
    public function setUrl(?string $url): void { $this->url = $url; }

    public function getPlanet(): ?Planets { return $this->planet; }
    public function setPlanet(?Planets $planet): void { $this->planet = $planet; }

    /**
     * @return Collection|Affiliations[]
     */
    public function getAffiliations(): Collection { return $this->affiliations; }

    public function addAffiliation(Affiliations $affiliation): self
    {
        if (!$this->affiliations->contains($affiliation)) {
            $this->affiliations[] = $affiliation;
        }
        return $this;
    }

    public function removeAffiliation(Affiliations $affiliation): self
    {
        $this->affiliations->removeElement($affiliation);
        return $this;
    }

    /**
     * @return Collection|Films[]
     */
    public function getFilms(): Collection { return $this->films; }

    public function addFilm(Films $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
        }
        return $this;
    }

    public function removeFilm(Films $film): self
    {
        $this->films->removeElement($film);
        return $this;
    }
}