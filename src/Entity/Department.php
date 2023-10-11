<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: School::class, inversedBy: 'departments')]
    #[ORM\JoinColumn(nullable: false)]
    private $school;

    #[ORM\OneToMany(targetEntity: StudentGroup::class, mappedBy: 'department')]
    private $studentGroups;

    #[ORM\OneToMany(targetEntity: Challenge::class, mappedBy: 'department')]
    private $challenges;

    public function __construct()
    {
        $this->studentGroups = new ArrayCollection();
        $this->challenges = new ArrayCollection();
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

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): self
    {
        $this->school = $school;

        return $this;
    }

    /**
     * @return Collection|StudentGroup[]
     */
    public function getStudentGroups(): Collection
    {
        return $this->studentGroups;
    }

    public function addStudentGroup(StudentGroup $studentGroup): self
    {
        if (!$this->studentGroups->contains($studentGroup)) {
            $this->studentGroups[] = $studentGroup;
            $studentGroup->setDepartment($this);
        }

        return $this;
    }

    public function removeStudentGroup(StudentGroup $studentGroup): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->studentGroups->removeElement($studentGroup)) {
            return $this;
        }

        if ($studentGroup->getDepartment() !== $this) {
            return $this;
        }

        $studentGroup->setDepartment(null);
        return $this;
    }

    /**
     * @return Collection<int, Challenge>
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenge $challenge): self
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges[] = $challenge;
            $challenge->setDepartment($this);
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->challenges->removeElement($challenge)) {
            return $this;
        }

        if ($challenge->getDepartment() !== $this) {
            return $this;
        }

        $challenge->setDepartment(null);
        return $this;
    }
}
