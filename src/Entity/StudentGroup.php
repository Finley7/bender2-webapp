<?php

namespace App\Entity;

use App\Repository\StudentGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentGroupRepository::class)]
class StudentGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'studentGroup')]
    private $students;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'studentGroups')]
    private $department;

    #[ORM\ManyToMany(targetEntity: Teacher::class, inversedBy: 'studentGroups')]
    private $supervisors;

    #[ORM\Column(type: 'string', length: 255)]
    private $cohort;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->supervisors = new ArrayCollection();
    }

    public function disectedGroupName() {

        $builtString = sprintf('(%s) - ', $this->name);
        $builtString .= $this->name[0] == 'S' ? 'Sittard, ' : 'Maastricht, ';
        $builtString .= 'Niveau ' . $this->name[1];
        $builtString .= ' Leerjaar ' . $this->name[2];
        $builtString .= ' ' . $this->type;

        return $builtString . (' klas ' . $this->name[4]);

    }

    public function getLocation() {
        return $this->name[0] == 'S' ? 'Sittard' : 'Maastricht';
    }

    public function getLevel() {
        return $this->name[1];
    }

    public function getYear() {
        return $this->name[2];
    }

    public function getIteration() {
        return $this->name[4];
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setStudentGroup($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->students->removeElement($student)) {
            return $this;
        }

        if ($student->getStudentGroup() !== $this) {
            return $this;
        }

        $student->setStudentGroup(null);
        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Collection|Teacher[]
     */
    public function getSupervisors(): Collection
    {
        return $this->supervisors;
    }

    public function addSupervisor(Teacher $teacher): self
    {
        if (!$this->supervisors->contains($teacher)) {
            $this->supervisors[] = $teacher;
        }

        return $this;
    }

    public function removeSupervisor(Teacher $teacher): self
    {
        $this->supervisors->removeElement($teacher);

        return $this;
    }

    public function getCohort(): ?string
    {
        return $this->cohort;
    }

    public function setCohort(string $cohort): self
    {
        $this->cohort = $cohort;

        return $this;
    }
}
