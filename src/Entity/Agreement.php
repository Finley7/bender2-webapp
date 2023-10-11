<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\AgreementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgreementRepository::class)]
class Agreement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'agreements')]
    #[ORM\JoinColumn(nullable: false)]
    private $student;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = true;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'agreements')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    use CreatedTrait;

    public function __construct()
    {
        $this->created = new \DateTime();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getAuthor(): ?Teacher
    {
        return $this->author;
    }

    public function setAuthor(?Teacher $teacher): self
    {
        $this->author = $teacher;

        return $this;
    }
}
