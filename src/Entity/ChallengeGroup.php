<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\ChallengeGroupRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeGroupRepository::class)]
class ChallengeGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'float')]
    private $progress = 0;

    #[ORM\ManyToOne(targetEntity: ChallengeRace::class, inversedBy: 'challengeGroups')]
    #[ORM\JoinColumn(nullable: false)]
    private $challenge;

    use CreatedTrait;

    public function __construct()
    {
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

    public function getProgress(): ?float
    {
        return $this->progress;
    }

    public function setProgress(float $progress): self
    {
        $this->progress = $progress;

        return $this;
    }

    public function getChallenge(): ?ChallengeRace
    {
        return $this->challenge;
    }

    public function setChallenge(?ChallengeRace $challengeRace): self
    {
        $this->challenge = $challengeRace;

        return $this;
    }
}
