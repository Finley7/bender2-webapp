<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\StudentCheckupMomentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentCheckupMomentRepository::class)]
class StudentCheckupMoment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'checkupMoments')]
    #[ORM\JoinColumn(nullable: false)]
    private $student;

    #[ORM\ManyToOne(targetEntity: CheckupMoment::class, inversedBy: 'students')]
    private $checkupMoment;

    #[ORM\Column(type: 'string', length: 255)]
    private $status = "unknown";

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $unique_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ip_address;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $medium;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lon;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lat;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ssid;

    #[ORM\Column(type: 'boolean')]
    private bool $isSuspicious = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rating;

    use CreatedTrait;

    public function serialize() {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'readableStatus' => $this->getReadableStatus(),
            'student' => $this->getStudent()->serialize(),
            'updated' => $this->getUpdatedWithTimezone('Europe/Amsterdam', 'H:i:s')
        ];
    }

    public function __construct() {
        $this->created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getCheckupMoment(): ?CheckupMoment
    {
        return $this->checkupMoment;
    }

    public function setCheckupMoment(?CheckupMoment $checkupMoment): self
    {
        $this->checkupMoment = $checkupMoment;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getReadableStatus(): string {

        switch($this->status) {
            case "present":
                return "Aanwezig";
            case "not_present":
                return "Niet aanwezig";
            case "registered":
                return "Aangemeld";
            case "too_late":
                return "Te laat";
            case "sick":
                return "Ziek";
            case "not_applicable":
                return "Niet van toepassing";
            default:
                return "Onbekend";
        }
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdatedWithTimezone($timezone = 'Europe/Amsterdam', $format = 'd-m-Y H:i'): string {
        $timezone = new \DateTimeZone($timezone);

        if($this->updated == null) {
            return "N.v.t.";
        }

        $this->updated->setTimezone($timezone);

        return $this->updated->format($format);
    }

    public function getUniqueId(): ?string
    {
        return $this->unique_id;
    }

    public function setUniqueId(?string $unique_id): self
    {
        $this->unique_id = $unique_id;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(string $ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    public function getMedium(): ?string
    {
        return $this->medium;
    }

    public function setMedium(string $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function getLon(): ?string
    {
        return $this->lon;
    }

    public function setLon(?string $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getSsid(): ?string
    {
        return $this->ssid;
    }

    public function setSsid(?string $ssid): self
    {
        $this->ssid = $ssid;

        return $this;
    }

    public function getIsSuspicious(): ?bool
    {
        return $this->isSuspicious;
    }

    public function setIsSuspicious(bool $isSuspicious): self
    {
        $this->isSuspicious = $isSuspicious;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
