<?php

namespace App\Entity\Traits;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait CreatedTrait
{
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $created;

    public function __construct() {
        $this->created = new DateTime();
    }

    public function create()
    {
        $this->setCreated(new DateTime());
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?DateTimeInterface $created): void
    {
        $this->created = $created;
    }
}
