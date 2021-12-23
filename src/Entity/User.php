<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $isim;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\ManyToMany(targetEntity=Grup::class, inversedBy="users")
     */
    private $groups;

    /**
     * @ORM\OneToOne(targetEntity=Kart::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $kart;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsim(): ?string
    {
        return $this->isim;
    }

    public function setIsim(string $isim): self
    {
        $this->isim = $isim;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|Grup[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Grup $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    public function removeGroup(Grup $group): self
    {
        $this->groups->removeElement($group);

        return $this;
    }

    public function getKart(): ?Kart
    {
        return $this->kart;
    }

    public function setKart(?Kart $kart): self
    {
        $this->kart = $kart;

        return $this;
    }
}
