<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\CheckupMomentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckupMomentRepository::class)]
class CheckupMoment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $start;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $end;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'checkupMoments')]
    private $createdBy;

    #[ORM\OneToMany(targetEntity: StudentCheckupMoment::class, mappedBy: 'checkupMoment', cascade: ['persist'])]
    private $students;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'float', nullable: true)]
    private $presence;

    #[ORM\Column(type: 'boolean')]
    private $isFinalOfDay;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->start = new \DateTime();
        $this->code = rand(1000, 9999);
        $this->created = new \DateTime();
    }

    use CreatedTrait;

    public function toJson($withStudents = false) {

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'code' => $this->getCode(),
            'start' => $this->getStartWithTimezone(),
            'students' => array_map(static fn($obj) => $obj->serialize(), $this->getStudents()->toArray())
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function getStartWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): ?string {
        $timezone = new \DateTimeZone($timezone);
        $this->start->setTimezone($timezone);

        return $this->start->format($format);
    }

    public function setStart(?\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        if($this->end != null) {
            $dateTimeZone = new \DateTimeZone('Europe/Amsterdam');
            $this->end->setTimezone($dateTimeZone);
        }
        
        return $this->end;
    }

    public function getEndWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);
        $this->end->setTimezone($timezone);

        return $this->end->format($format);
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getCreatedBy(): ?Teacher
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Teacher $teacher): self
    {
        $this->createdBy = $teacher;

        return $this;
    }

    public function getPresentStudents(): array {

        $presentStudents = [];

        foreach($this->students as $student) {
            if($student->getStatus() == "present" || $student->getStatus() == "too_late") {
                $presentStudents[] = $student;
            }
        }

        return $presentStudents;

    }

    public function getStudent(Student $checkStudent) {

        foreach($this->students as $student) {
            if($student->getStudent() == $checkStudent) {
                return $student;
            }
        }

        return false;
    }

    /**
     * @return Collection|StudentCheckupMoment[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(StudentCheckupMoment $studentCheckupMoment): self
    {
        if (!$this->students->contains($studentCheckupMoment)) {
            $this->students[] = $studentCheckupMoment;
            $studentCheckupMoment->setCheckupMoment($this);
        }

        return $this;
    }

    public function removeStudent(StudentCheckupMoment $studentCheckupMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->students->removeElement($studentCheckupMoment)) {
            return $this;
        }

        if ($studentCheckupMoment->getCheckupMoment() !== $this) {
            return $this;
        }

        $studentCheckupMoment->setCheckupMoment(null);
        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getPresence(): ?float
    {
        return $this->presence;
    }

    public function setPresence(?float $presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    public function getIsFinalOfDay(): ?bool
    {
        return $this->isFinalOfDay;
    }

    public function setIsFinalOfDay(bool $isFinalOfDay): self
    {
        $this->isFinalOfDay = $isFinalOfDay;

        return $this;
    }

    public function getCheckupMomentRating() {

        $count = 0;

        foreach($this->getPresentStudents() as $student) {
            $count += $student->getRating();
        }

        return ($count / count($this->getPresentStudents()));
    }
}
