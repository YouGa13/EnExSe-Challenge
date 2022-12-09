<?php

namespace App\Entity;

use App\Repository\UserEnexseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserEnexseRepository::class)]
class UserEnexse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $username = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): array
    {
        return $this->username;
    }

    public function setUsername(array $username): self
    {
        $this->username = $username;

        return $this;
    }
}
