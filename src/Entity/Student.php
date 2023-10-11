<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @UniqueEntity("email")
 * @UniqueEntity("studentNumber")
 */
#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'integer')]
    private $studentNumber;

    #[ORM\Column(type: 'boolean')]
    private bool $isNew = true;

    #[ORM\ManyToOne(targetEntity: StudentGroup::class, inversedBy: 'students')]
    private $studentGroup;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $accessToken;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $lastLogin;

    #[ORM\OneToMany(targetEntity: StudentCheckupMoment::class, mappedBy: 'student')]
    private $checkupMoments;

    #[ORM\OneToMany(targetEntity: UserAccessToken::class, mappedBy: 'user')]
    private $accessTokens;

    #[ORM\OneToMany(targetEntity: ProgressMoment::class, mappedBy: 'student')]
    private $progressMoments;

    #[ORM\Column(type: 'string', length: 255)]
    private string $defaultCheckupMomentStatus = "unknown";

    #[ORM\Column(type: 'uuid')]
    private \Symfony\Component\Uid\UuidV4 $uuidV4;

    #[ORM\OneToMany(targetEntity: Agreement::class, mappedBy: 'student', orphanRemoval: true)]
    private $agreements;

    #[ORM\ManyToMany(targetEntity: DCMoment::class, mappedBy: 'students', orphanRemoval: true)]
    private $DCMoments;

    #[ORM\OneToMany(targetEntity: StudentResetToken::class, mappedBy: 'student', orphanRemoval: true)]
    private $studentResetTokens;

    use CreatedTrait;

    public function __construct() {
        $this->accessToken = bin2hex(openssl_random_pseudo_bytes(32));
        $this->checkupMoments = new ArrayCollection();
        $this->accessTokens = new ArrayCollection();
        $this->progressMoments = new ArrayCollection();
        $this->uuidV4 = Uuid::v4();
        $this->agreements = new ArrayCollection();
        $this->DCMoments = new ArrayCollection();
        $this->studentResetTokens = new ArrayCollection();
    }

    public function serialize() {
        return [
            'id' => $this->getId(),
            'fullName' => $this->getFirstName() . ' ' . $this->getLastName(),
            'isNew' => $this->getIsNew(),
            'studentGroup' => $this->getStudentGroup()->getName(),
            'studentNumber' => $this->getStudentNumber(),
            'lastLogin' => $this->getLastLogin()?->format('d-m-Y H:i')
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getStudentNumber(): ?int
    {
        return $this->studentNumber;
    }

    public function setStudentNumber(int $studentNumber): self
    {
        $this->studentNumber = $studentNumber;

        return $this;
    }

    public function getIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(bool $isNew): self
    {
        $this->isNew = $isNew;

        return $this;
    }

    public function getStudentGroup(): ?StudentGroup
    {
        return $this->studentGroup;
    }

    public function setStudentGroup(?StudentGroup $studentGroup): self
    {
        $this->studentGroup = $studentGroup;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLatestAccessToken(): ?string {

       return $this->accessTokens->last()->getToken();

    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(?string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getNotPresentCheckupMoments(): array {

        $notPresent = [];

        foreach($this->checkupMoments as $checkupMoment) {
            if($checkupMoment->getStatus() == "not_present") {
                $notPresent[] = $notPresent;
            }
        }

        return $notPresent;

    }

    /**
     * @return Collection|StudentCheckupMoment[]
     */
    public function getCheckupMoments(): Collection
    {
        return $this->checkupMoments;
    }

    public function addCheckupMoment(StudentCheckupMoment $studentCheckupMoment): self
    {
        if (!$this->checkupMoments->contains($studentCheckupMoment)) {
            $this->checkupMoments[] = $studentCheckupMoment;
            $studentCheckupMoment->setStudent($this);
        }

        return $this;
    }

    public function removeCheckupMoment(StudentCheckupMoment $studentCheckupMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->checkupMoments->removeElement($studentCheckupMoment)) {
            return $this;
        }

        if ($studentCheckupMoment->getStudent() !== $this) {
            return $this;
        }

        $studentCheckupMoment->setStudent(null);
        return $this;
    }

    /**
     * @return Collection|UserAccessToken[]
     */
    public function getAccessTokens(): Collection
    {
        return $this->accessTokens;
    }

    public function addAccessToken(UserAccessToken $userAccessToken): self
    {
        if (!$this->accessTokens->contains($userAccessToken)) {
            $this->accessTokens[] = $userAccessToken;
            $userAccessToken->setUser($this);
        }

        return $this;
    }

    public function removeAccessToken(UserAccessToken $userAccessToken): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->accessTokens->removeElement($userAccessToken)) {
            return $this;
        }

        if ($userAccessToken->getUser() !== $this) {
            return $this;
        }

        $userAccessToken->setUser(null);
        return $this;
    }

    /**
     * @return Collection|ProgressMoment[]
     */
    public function getProgressMoments(): Collection
    {
        return $this->progressMoments;
    }

    public function addProgressMoment(ProgressMoment $progressMoment): self
    {
        if (!$this->progressMoments->contains($progressMoment)) {
            $this->progressMoments[] = $progressMoment;
            $progressMoment->setStudent($this);
        }

        return $this;
    }

    public function removeProgressMoment(ProgressMoment $progressMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->progressMoments->removeElement($progressMoment)) {
            return $this;
        }

        if ($progressMoment->getStudent() !== $this) {
            return $this;
        }

        $progressMoment->setStudent(null);
        return $this;
    }

    public function getDefaultCheckupMomentStatus(): ?string
    {
        return $this->defaultCheckupMomentStatus;
    }

    public function setDefaultCheckupMomentStatus(string $defaultCheckupMomentStatus): self
    {
        $this->defaultCheckupMomentStatus = $defaultCheckupMomentStatus;

        return $this;
    }

    public function getUuid()
    {
        return $this->uuidV4;
    }

    public function setUuid($uuid): self
    {
        $this->uuidV4 = $uuid;

        return $this;
    }

    /**
     * @return Collection<int, Agreement>
     */
    public function getAgreements(): Collection
    {
        return $this->agreements;
    }

    public function addAgreement(Agreement $agreement): self
    {
        if (!$this->agreements->contains($agreement)) {
            $this->agreements[] = $agreement;
            $agreement->setStudent($this);
        }

        return $this;
    }

    public function removeAgreement(Agreement $agreement): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->agreements->removeElement($agreement)) {
            return $this;
        }

        if ($agreement->getStudent() !== $this) {
            return $this;
        }

        $agreement->setStudent(null);
        return $this;
    }

    /**
     * @return Collection<int, DCMoment>
     */
    public function getDCMoments(): Collection
    {
        return $this->DCMoments;
    }

    public function addDCMoment(DCMoment $dCMoment): self
    {
        if (!$this->DCMoments->contains($dCMoment)) {
            $this->DCMoments[] = $dCMoment;
            $dCMoment->setStudents($this);
        }

        return $this;
    }

    public function removeDCMoment(DCMoment $dCMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->DCMoments->removeElement($dCMoment)) {
            return $this;
        }

        if ($dCMoment->getStudents() !== $this) {
            return $this;
        }

        $dCMoment->setStudents(null);
        return $this;
    }

    /**
     * @return Collection<int, StudentResetToken>
     */
    public function getStudentResetTokens(): Collection
    {
        return $this->studentResetTokens;
    }

    public function addStudentResetToken(StudentResetToken $studentResetToken): self
    {
        if (!$this->studentResetTokens->contains($studentResetToken)) {
            $this->studentResetTokens[] = $studentResetToken;
            $studentResetToken->setStudent($this);
        }

        return $this;
    }

    public function removeStudentResetToken(StudentResetToken $studentResetToken): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->studentResetTokens->removeElement($studentResetToken)) {
            return $this;
        }

        if ($studentResetToken->getStudent() !== $this) {
            return $this;
        }

        $studentResetToken->setStudent(null);
        return $this;
    }

    public function getRoles(): array
    {
        return ['USER_STUDENT'];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->studentNumber;
    }
}
