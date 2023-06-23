<?php

namespace App\Entity;

use App\Repository\CharacterSheetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterSheetRepository::class)]
class CharacterSheet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $initiative = null;

    #[ORM\Column]
    private ?int $hpMax = null;

    #[ORM\Column]
    private ?int $actualHp = null;

    #[ORM\Column]
    private ?int $mpMax = null;

    #[ORM\Column]
    private ?int $actualMp = null;

    #[ORM\Column]
    private ?int $strength = null;

    #[ORM\Column]
    private ?int $dexterity = null;

    #[ORM\Column]
    private ?int $stamina = null;

    #[ORM\Column]
    private ?int $intelligence = null;

    #[ORM\Column]
    private ?int $wisdom = null;

    #[ORM\Column]
    private ?int $luck = null;

    #[ORM\OneToMany(mappedBy: 'CharacterSheet', targetEntity: Equipement::class)]
    private Collection $equipements;

    #[ORM\OneToMany(mappedBy: 'CharacterSheet', targetEntity: Skill::class)]
    private Collection $skills;

    #[ORM\ManyToOne(inversedBy: 'CharacterSheet')]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'CharacterSheet')]
    private ?User $CharacterSheetUser = null;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->skills = new ArrayCollection();
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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(int $initiative): static
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getHpMax(): ?int
    {
        return $this->hpMax;
    }

    public function setHpMax(int $hpMax): static
    {
        $this->hpMax = $hpMax;

        return $this;
    }

    public function getActualHp(): ?int
    {
        return $this->actualHp;
    }

    public function setActualHp(int $actualHp): static
    {
        $this->actualHp = $actualHp;

        return $this;
    }

    public function getMpMax(): ?int
    {
        return $this->mpMax;
    }

    public function setMpMax(int $mpMax): static
    {
        $this->mpMax = $mpMax;

        return $this;
    }

    public function getActualMp(): ?int
    {
        return $this->actualMp;
    }

    public function setActualMp(int $actualMp): static
    {
        $this->actualMp = $actualMp;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): static
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): static
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    public function setStamina(int $stamina): static
    {
        $this->stamina = $stamina;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): static
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): static
    {
        $this->luck = $luck;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getCharacterSheet() === $this) {
                $equipement->setCharacterSheet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): static
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): static
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getCharacterSheet() === $this) {
                $skill->setCharacterSheet(null);
            }
        }

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getCharacterSheetUser(): ?User
    {
        return $this->CharacterSheetUser;
    }

    public function setCharacterSheetUser(?User $CharacterSheetUser): static
    {
        $this->CharacterSheetUser = $CharacterSheetUser;

        return $this;
    }
}
