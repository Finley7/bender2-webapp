<?php

namespace App\Entity;

use App\Repository\ChallengeBoardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeBoardRepository::class)]
class ChallengeBoard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $body;

    #[ORM\Column(type: 'integer')]
    private $type;

    #[ORM\OneToMany(targetEntity: ChallengeBoardAttachment::class, mappedBy: 'board')]
    private $attachments;

    #[ORM\ManyToOne(targetEntity: Challenge::class, inversedBy: 'challengeGroupBoards')]
    #[ORM\JoinColumn(nullable: false)]
    private $challenge;

    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, ChallengeBoardAttachment>
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(ChallengeBoardAttachment $challengeBoardAttachment): self
    {
        if (!$this->attachments->contains($challengeBoardAttachment)) {
            $this->attachments[] = $challengeBoardAttachment;
            $challengeBoardAttachment->setBoard($this);
        }

        return $this;
    }

    public function removeAttachment(ChallengeBoardAttachment $challengeBoardAttachment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->attachments->removeElement($challengeBoardAttachment)) {
            return $this;
        }

        if ($challengeBoardAttachment->getBoard() !== $this) {
            return $this;
        }

        $challengeBoardAttachment->setBoard(null);
        return $this;
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
