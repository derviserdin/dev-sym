<?php

namespace App\Entity;

use App\Repository\KartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KartRepository::class)
 */
class Kart
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
    private $no;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="kart", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(string $no): self
    {
        $this->no = $no;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setKart(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getKart() !== $this) {
            $user->setKart($this);
        }

        $this->user = $user;

        return $this;
    }
}
