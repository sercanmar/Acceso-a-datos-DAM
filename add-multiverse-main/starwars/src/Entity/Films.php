<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Films
 * @ORM\Table(name="films")
 * @ORM\Entity
 */
class Films
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"films", "characters","deaths"})
     */
    private $id;

    /**
     * @ORM\Column(name="episode", type="string", length=12, nullable=true)
     * @Groups({"films", "characters"})
     */
    private $episode;

    /**
     * @ORM\Column(name="title", type="string", length=30, nullable=true)
     * @Groups({"films", "characters"})
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="Characters", mappedBy="films")
     * @Groups({"films"})
     */
    private $characters;

    public function __construct()
    {

    }

    public function getId(): ?int { return $this->id; }

    public function getEpisode(): ?string { return $this->episode; }
    public function setEpisode(?string $episode): void { $this->episode = $episode; }

    public function getTitle(): ?string { return $this->title; }
    public function setTitle(?string $title): void { $this->title = $title; }

    /**
     * @return Collection|Characters[]
     */
    public function getCharacters(): Collection { return $this->characters; }

    public function addCharacter(Characters $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->addFilm($this);
        }
        return $this;
    }

    public function removeCharacter(Characters $character): self
    {
        if ($this->characters->removeElement($character)) {
            $character->removeFilm($this);
        }
        return $this;
    }
}