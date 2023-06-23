<?php

namespace App\Entity;

use App\Repository\GameMasterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameMasterRepository::class)]
class GameMaster extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'gameMaster', targetEntity: Game::class)]
    private Collection $game;

    public function __construct()
    {
        parent::__construct();
        $this->game = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGame(): Collection
    {
        return $this->game;
    }

    public function addGame(Game $game): static
    {
        if (!$this->game->contains($game)) {
            $this->game->add($game);
            $game->setGameMaster($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->game->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getGameMaster() === $this) {
                $game->setGameMaster(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        $roles = parent::getRoles();
        $roles[] = 'ROLE_GAMEMASTER';

        return array_unique($roles);
    }
}
