<?php

namespace App\Entity;

use App\Repository\UserAccessTokenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserAccessTokenRepository::class)]
class UserAccessToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'accessTokens')]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'string', length: 255)]
    private string $token;

    #[ORM\Column(type: 'datetime')]
    private $expires;

    #[ORM\Column(type: 'boolean')]
    private bool $hasExpired = false;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type = 'DESKTOP_APP';

    public function __construct() {
        $this->token = bin2hex(openssl_random_pseudo_bytes(32));
        $this->created = new \DateTime();
        $this->expires = new \DateTime('+1 year');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Student
    {
        return $this->user;
    }

    public function setUser(?Student $student): self
    {
        $this->user = $student;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getExpires(): ?\DateTimeInterface
    {
        return $this->expires;
    }

    public function setExpires(\DateTimeInterface $expires): self
    {
        $this->expires = $expires;

        return $this;
    }

    public function getHasExpired(): ?bool
    {
        return $this->hasExpired;
    }

    public function setHasExpired(bool $hasExpired): self
    {
        $this->hasExpired = $hasExpired;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
