<?php

namespace App\Entity;

use App\Repository\UserEnexseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserEnexseRepository::class)]
#[UniqueEntity(fields: ['userid'], message: 'Erreur ! Veuillez rénouveler votre inscription')]
class UserEnexse
{   
    
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();

        $alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $chiffres = "123456789";

        $chiffre_aleatoire = "";
        $lettre_aleatoire ="";
        for ($i = 0; $i<2; $i++){
            $lettre_aleatoire = $lettre_aleatoire . $alphabet[rand(0, 51)];
        }
        for ($i = 0; $i<5; $i++){
            $chiffre_aleatoire = $chiffre_aleatoire . $chiffres[rand(0, 8)];
        };
        $this->userid = $lettre_aleatoire . $chiffre_aleatoire;
    }

    #[ORM\Id]
    #[ORM\Column]
    private ?string $userid;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $fullname = null;

    #[ORM\Column(length: 100)]
    private ?string $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $userAdress = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(type: 'datetime_immutable', options:['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    #[ORM\Column(length: 14)]
    private ?string $userContact = null;

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(string $userid): self
    {
        $this->userid = $userid;

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

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getUserAdress(): ?string
    {
        return $this->userAdress;
    }

    public function setUserAdress(string $userAdress): self
    {
        $this->userAdress = $userAdress;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUserContact(): ?string
    {
        return $this->userContact;
    }

    public function setUserContact(string $userContact): self
    {
        $this->userContact = $userContact;

        return $this;
    }
}
