<?php

namespace App\Entity;

use App\Repository\KontrolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KontrolRepository", repositoryClass=KontrolRepository::class)
 */
class Kontrol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    # @Assert\NotBlank() alanın boş olmaması gerektiğini söyler
    #@Assert\Blank() Alanın boş olması gerektiğini söyler
    #@Assert\NotNull Alan boş olmaması gerek
    #@Assert\IsNull alan dolu mu boş mu kontrol eder
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="5",max="20",minMessage="Minimum % karakter olmalı",maxMessage="Maximum 20 karakter olmalı")
    */
    private $isim;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email ()
     */

    private $url;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsim(): ?string
    {
        return $this->isim;
    }

    #@Assert\IsFalse ise tam tersi
    /**
     * @param $isim
     * @Assert\IsTrue(message="Alana Sadece Derviş Yazılır")
     * @return bool
     */
    public function isimCheck()
    {
        return $this->isim === 'Derviş';
    }

    public function setIsim(string $isim): self
    {
        $this->isim = $isim;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }


}
