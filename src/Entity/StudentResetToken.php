<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\StudentResetTokenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentResetTokenRepository::class)]
class StudentResetToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'studentResetTokens')]
    #[ORM\JoinColumn(nullable: false)]
    private $student;

    #[ORM\Column(type: 'string', length: 255)]
    private string $token;

    #[ORM\Column(type: 'datetime')]
    private $expires;

    #[ORM\Column(type: 'boolean')]
    private bool $isUsed = false;

    use CreatedTrait;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->expires = new \DateTime('+2 hours');
        $this->token = bin2hex(random_bytes(32));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

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

    public function getExpiresWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);
        $this->expires->setTimezone($timezone);

        return $this->expires->format($format);
    }

    public function getCreatedWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);
        $this->created->setTimezone($timezone);

        return $this->created->format($format);
    }

    public function getIsUsed(): ?bool
    {
        return $this->isUsed;
    }

    public function setIsUsed(bool $isUsed): self
    {
        $this->isUsed = $isUsed;

        return $this;
    }
}
