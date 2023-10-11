<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\ChallengeRaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeRaceRepository::class)]
class ChallengeRace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: ChallengeGroup::class, mappedBy: 'challenge', cascade: ['persist'])]
    private $challengeGroups;

    #[ORM\ManyToOne(targetEntity: Challenge::class, inversedBy: 'races')]
    private $challenge;

    use CreatedTrait;

    public function __construct()
    {
        $this->challengeGroups = new ArrayCollection();
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
     * @return Collection|ChallengeGroup[]
     */
    public function getChallengeGroups(): Collection
    {
        return $this->challengeGroups;
    }
    
    public function addChallengeGroup(ChallengeGroup $challengeGroup): self
    {
        if (!$this->challengeGroups->contains($challengeGroup)) {
            $this->challengeGroups[] = $challengeGroup;
            $challengeGroup->setChallenge($this);
        }

        return $this;
    }

    public function removeChallengeGroup(ChallengeGroup $challengeGroup): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->challengeGroups->removeElement($challengeGroup)) {
            return $this;
        }

        if ($challengeGroup->getChallenge() !== $this) {
            return $this;
        }

        $challengeGroup->setChallenge(null);
        return $this;
    }

    public function getHighestGroup() {


        $progressess = [];

        foreach($this->getChallengeGroups() as $challengeGroup) {
            $progressess[] = $challengeGroup->getProgress();
        }

        arsort($progressess);


        return $progressess[key($progressess)];
    }

    public function getChallenge(): ?Challenge
    {
        return $this->challenge;
    }

    public function setChallenge(?Challenge $challenge): self
    {
        $this->challenge = $challenge;

        return $this;
    }
}
