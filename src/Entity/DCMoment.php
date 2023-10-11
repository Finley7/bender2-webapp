<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\DCMomentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DCMomentRepository::class)]
class DCMoment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'DCMoments')]
    #[ORM\JoinColumn(nullable: false)]
    private $students;

    #[ORM\Column(type: 'text')]
    private $comments;

    #[ORM\ManyToMany(targetEntity: DCTool::class, inversedBy: 'DCMoment')]
    private $tools;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'DCMoments')]
    private $coach;

    #[ORM\Column(type: 'time', nullable: true)]
    private $enddate;

    use CreatedTrait;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): ?Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->addDCMoment($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            $student->removeDCMoment($this);
        }

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @return Collection<int, DCTool>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(DCTool $dcTool): self
    {
        if (!$this->tools->contains($dcTool)) {
            $this->tools[] = $dcTool;
            $dcTool->addDCMoment($this);
        }

        return $this;
    }

    public function removeTool(DCTool $dcTool): self
    {
        if ($this->tools->removeElement($dcTool)) {
            $dcTool->removeDCMoment($this);
        }

        return $this;
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

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(?\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getCreatedWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);
        $this->created->setTimezone($timezone);

        return $this->created->format($format);
    }

    public function getEndWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);
        $this->enddate->setTimezone($timezone);

        return $this->enddate->format($format);
    }
}
