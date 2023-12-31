<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\EquipementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $damage = null;

    #[ORM\Column(name: '`range`')]
    private ?int $range = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    private ?CharacterSheet $CharacterSheet = null;

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

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): static
    {
        $this->damage = $damage;

        return $this;
    }

    public function getRange(): ?int
    {
        return $this->range;
    }

    public function setRange(int $range): static
    {
        $this->range = $range;

        return $this;
    }

    public function getCharacterSheet(): ?CharacterSheet
    {
        return $this->CharacterSheet;
    }

    public function setCharacterSheet(?CharacterSheet $CharacterSheet): static
    {
        $this->CharacterSheet = $CharacterSheet;

        return $this;
    }
}
