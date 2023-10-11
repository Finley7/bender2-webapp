<?php

namespace App\Entity;

use App\Repository\ProgressMomentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressMomentRepository::class)]
class ProgressMoment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'progressMoments')]
    #[ORM\JoinColumn(nullable: false)]
    private $coach;

    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'progressMoments')]
    private $student;

    #[ORM\Column(type: 'text')]
    private $coachMessage;

    #[ORM\Column(type: 'text', nullable: true)]
    private $studentMessage;

    #[ORM\Column(type: 'integer')]
    private $rating;

    public function __construct() {
        $this->created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);
        $this->created->setTimezone($timezone);

        return $this->created->format($format);
    }

    public function getCoach(): ?Teacher
    {
        return $this->coach;
    }

    public function setCoach(?Teacher $teacher): self
    {
        $this->coach = $teacher;

        return $this;
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

    public function getCoachMessage(): ?string
    {
        return $this->coachMessage;
    }

    public function setCoachMessage(string $coachMessage): self
    {
        $this->coachMessage = $coachMessage;

        return $this;
    }

    public function getStudentMessage(): ?string
    {
        return $this->studentMessage;
    }

    public function setStudentMessage(?string $studentMessage): self
    {
        $this->studentMessage = $studentMessage;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
