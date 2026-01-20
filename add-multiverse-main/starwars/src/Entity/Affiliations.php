<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Affiliations
 * @ORM\Table(name="affiliations")
 * @ORM\Entity
 */
class Affiliations
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"affiliations", "characters"})
     */
    private $id;

    /**
     * @ORM\Column(name="affiliation", type="string", length=255, nullable=true)
     * @Groups({"affiliations", "characters"})
     */
    private $affiliation;

    /**
     * @ORM\ManyToMany(targetEntity="Characters", mappedBy="affiliations")
     * @Groups({"affiliations"})
     */
    private $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getAffiliation(): ?string { return $this->affiliation; }
    public function setAffiliation(?string $affiliation): void { $this->affiliation = $affiliation; }

    /**
     * @return Collection|Characters[]
     */
    public function getCharacters(): Collection { return $this->characters; }

    public function addCharacter(Characters $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->addAffiliation($this);
        }
        return $this;
    }

    public function removeCharacter(Characters $character): self
    {
        if ($this->characters->removeElement($character)) {
            $character->removeAffiliation($this);
        }
        return $this;
    }
}