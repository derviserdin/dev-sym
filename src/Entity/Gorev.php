<?php

namespace App\Entity;

use App\Repository\GorevRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GorevRepository::class)
 */
class Gorev
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
    private $gorev;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $bitisZamani;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGorev(): ?string
    {
        return $this->gorev;
    }

    public function setGorev(string $gorev): self
    {
        $this->gorev = $gorev;

        return $this;
    }

    public function getBitisZamani(): ?\DateTimeInterface
    {
        return $this->bitisZamani;
    }

    public function setBitisZamani(?\DateTimeInterface $bitisZamani): self
    {
        $this->bitisZamani = $bitisZamani;

        return $this;
    }
}
