<?php

namespace App\Entity;

use App\Repository\GroupTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupTemplateRepository::class)]
class GroupTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $isGlobalAvailable;

    #[ORM\ManyToMany(targetEntity: StudentGroup::class)]
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
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

    public function getIsGlobalAvailable(): ?bool
    {
        return $this->isGlobalAvailable;
    }

    public function setIsGlobalAvailable(bool $isGlobalAvailable): self
    {
        $this->isGlobalAvailable = $isGlobalAvailable;

        return $this;
    }

    /**
     * @return Collection|StudentGroup[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(StudentGroup $studentGroup): self
    {
        if (!$this->groups->contains($studentGroup)) {
            $this->groups[] = $studentGroup;
        }

        return $this;
    }

    public function removeGroup(StudentGroup $studentGroup): self
    {
        $this->groups->removeElement($studentGroup);

        return $this;
    }
}
