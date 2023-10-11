<?php

namespace App\Entity;

use App\Repository\DCToolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DCToolRepository::class)]
class DCTool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: DCMoment::class, mappedBy: 'tools')]
    private $DCMoment;

    public function __construct()
    {
        $this->DCMoment = new ArrayCollection();
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
     * @return Collection<int, DCMoment>
     */
    public function getDCMoment(): Collection
    {
        return $this->DCMoment;
    }

    public function addDCMoment(DCMoment $dCMoment): self
    {
        if (!$this->DCMoment->contains($dCMoment)) {
            $this->DCMoment[] = $dCMoment;
        }

        return $this;
    }

    public function removeDCMoment(DCMoment $dCMoment): self
    {
        $this->DCMoment->removeElement($dCMoment);

        return $this;
    }
}
