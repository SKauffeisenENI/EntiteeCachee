<?php

namespace App\Entity;

use App\Repository\MotMystereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotMystereRepository::class)
 */
class MotMystere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $equipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMot(): ?string
    {
        return $this->mot;
    }

    public function setMot(string $mot): self
    {
        $this->mot = $mot;

        return $this;
    }

    public function getEquipe(): ?int
    {
        return $this->equipe;
    }

    public function setEquipe(?int $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
}
