<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChallengeRepository;

#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: ChallengeRace::class, mappedBy: 'challenge')]
    private $races;

    #[ORM\OneToMany(targetEntity: ChallengeBoard::class, mappedBy: 'challenge')]
    private $challengeGroupBoards;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'challenges')]
    private $department;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $creboCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cohort;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $versionKD;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'challenges')]
    private $author;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstDeterminer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $secondDeterminer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $version;

    public function __construct()
    {
        $this->races = new ArrayCollection();
        $this->challengeGroupBoards = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
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
     * @return Collection<int, ChallengeRace>
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(ChallengeRace $challengeRace): self
    {
        if (!$this->races->contains($challengeRace)) {
            $this->races[] = $challengeRace;
            $challengeRace->setChallenge($this);
        }

        return $this;
    }

    public function removeRace(ChallengeRace $challengeRace): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->races->removeElement($challengeRace)) {
            return $this;
        }

        if ($challengeRace->getChallenge() !== $this) {
            return $this;
        }

        $challengeRace->setChallenge(null);
        return $this;
    }

    /**
     * @return Collection<int, ChallengeBoard>
     */
    public function getChallengeGroupBoards(): Collection
    {
        return $this->challengeGroupBoards;
    }

    public function addChallengeGroupBoard(ChallengeBoard $challengeBoard): self
    {
        if (!$this->challengeGroupBoards->contains($challengeBoard)) {
            $this->challengeGroupBoards[] = $challengeBoard;
            $challengeBoard->setChallenge($this);
        }

        return $this;
    }

    public function removeChallengeGroupBoard(ChallengeBoard $challengeBoard): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->challengeGroupBoards->removeElement($challengeBoard)) {
            return $this;
        }

        if ($challengeBoard->getChallenge() !== $this) {
            return $this;
        }

        $challengeBoard->setChallenge(null);
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

    public function getCreboCode(): ?string
    {
        return $this->creboCode;
    }

    public function setCreboCode(?string $creboCode): self
    {
        $this->creboCode = $creboCode;

        return $this;
    }

    public function getCohort(): ?string
    {
        return $this->cohort;
    }

    public function setCohort(?string $cohort): self
    {
        $this->cohort = $cohort;

        return $this;
    }

    public function getVersionKD(): ?string
    {
        return $this->versionKD;
    }

    public function setVersionKD(?string $versionKD): self
    {
        $this->versionKD = $versionKD;

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

    public function getFirstDeterminer(): ?string
    {
        return $this->firstDeterminer;
    }

    public function setFirstDeterminer(?string $firstDeterminer): self
    {
        $this->firstDeterminer = $firstDeterminer;

        return $this;
    }

    public function getSecondDeterminer(): ?string
    {
        return $this->secondDeterminer;
    }

    public function setSecondDeterminer(?string $secondDeterminer): self
    {
        $this->secondDeterminer = $secondDeterminer;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

        return $this;
    }
}