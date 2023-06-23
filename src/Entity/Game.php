<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: CharacterSheet::class)]
    private Collection $CharacterSheet;

    #[ORM\ManyToOne(inversedBy: 'Game')]
    private ?User $gamer = null;

    #[ORM\ManyToOne(inversedBy: 'game')]
    private ?GameMaster $gameMaster = null;

    public function __construct()
    {
        $this->CharacterSheet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CharacterSheet>
     */
    public function getCharacterSheet(): Collection
    {
        return $this->CharacterSheet;
    }

    public function addCharacterSheet(CharacterSheet $characterSheet): static
    {
        if (!$this->CharacterSheet->contains($characterSheet)) {
            $this->CharacterSheet->add($characterSheet);
            $characterSheet->setGame($this);
        }

        return $this;
    }

    public function removeCharacterSheet(CharacterSheet $characterSheet): static
    {
        if ($this->CharacterSheet->removeElement($characterSheet)) {
            // set the owning side to null (unless already changed)
            if ($characterSheet->getGame() === $this) {
                $characterSheet->setGame(null);
            }
        }

        return $this;
    }

    public function getGamer(): ?User
    {
        return $this->gamer;
    }

    public function setGamer(?User $gamer): static
    {
        $this->gamer = $gamer;

        return $this;
    }

    public function getGameMaster(): ?GameMaster
    {
        return $this->gameMaster;
    }

    public function setGameMaster(?GameMaster $gameMaster): static
    {
        $this->gameMaster = $gameMaster;

        return $this;
    }
}