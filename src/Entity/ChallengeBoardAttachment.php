<?php

namespace App\Entity;

use App\Repository\ChallengeBoardAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeBoardAttachmentRepository::class)]
class ChallengeBoardAttachment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ChallengeBoard::class, inversedBy: 'attachments')]
    #[ORM\JoinColumn(nullable: false)]
    private $board;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $realName;

    #[ORM\Column(type: 'integer')]
    private $size;

    #[ORM\Column(type: 'string', length: 255)]
    private $mimeType;

    #[ORM\Column(type: 'string', length: 255)]
    private $extension;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'documents')]
    private $createdBy;

    public function __construct()
    {
        $this->created = new \DateTime('now');
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

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
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

    public function getCreatedBy(): ?Teacher
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Teacher $teacher): self
    {
        $this->createdBy = $teacher;

        return $this;
    }

    public function getBoard(): ?ChallengeBoard
    {
        return $this->board;
    }

    public function setBoard(?ChallengeBoard $challengeBoard): self
    {
        $this->board = $challengeBoard;

        return $this;
    }
}
