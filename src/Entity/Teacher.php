<?php

namespace App\Entity;

use App\Entity\Traits\CreatedTrait;
use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @UniqueEntity("lettercode")
 */
#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lettercode;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\OneToMany(targetEntity: CheckupMoment::class, mappedBy: 'createdBy')]
    private $checkupMoments;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $accessToken;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $lastLogin;

    #[ORM\ManyToMany(targetEntity: StudentGroup::class, mappedBy: 'supervisors')]
    private $studentGroups;

    #[ORM\OneToMany(targetEntity: ProgressMoment::class, mappedBy: 'coach')]
    private $progressMoments;

    #[ORM\ManyToMany(targetEntity: \App\Entity\UserRole::class, inversedBy: 'users')]
    private $userRoles;

    #[ORM\OneToMany(targetEntity: Challenge::class, mappedBy: 'author')]
    private $challenges;

    #[ORM\OneToMany(targetEntity: Agreement::class, mappedBy: 'author', orphanRemoval: true)]
    private $agreements;

    #[ORM\OneToMany(targetEntity: DCMoment::class, mappedBy: 'coach')]
    private $DCMoments;

    public function serialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'lettercode' => $this->getLetterCode(),
            'lastLogin' => $this->getLastLogin()?->format('d-m-Y H:i')
        ];
    }

    public function __construct()
    {
        $this->checkupMoments = new ArrayCollection();
        $this->accessToken = bin2hex(openssl_random_pseudo_bytes(32));
        $this->created = new \DateTime();
        $this->studentGroups = new ArrayCollection();
        $this->progressMoments = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
        $this->challenges = new ArrayCollection();
        $this->agreements = new ArrayCollection();
        $this->DCMoments = new ArrayCollection();
    }

    use CreatedTrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLetterCode(): ?string
    {
        return $this->lettercode;
    }

    public function setLetterCode(string $lettercode): self
    {
        $this->lettercode = $lettercode;

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

    /**
     * @return Collection|CheckupMoment[]
     */
    public function getCheckupMoments(): Collection
    {
        return $this->checkupMoments;
    }

    public function addCheckupMoment(CheckupMoment $checkupMoment): self
    {
        if (!$this->checkupMoments->contains($checkupMoment)) {
            $this->checkupMoments[] = $checkupMoment;
            $checkupMoment->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCheckupMoment(CheckupMoment $checkupMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->checkupMoments->removeElement($checkupMoment)) {
            return $this;
        }
        
        if ($checkupMoment->getCreatedBy() !== $this) {
            return $this;
        }
        
        $checkupMoment->setCreatedBy(null);
        return $this;
    }

    public function getRoles(): array
    {
        $roles = ['ROLE_USER', 'ROLE_TEACHER'];
        if($this->getStudentGroups()->count() > 0) {
            $roles[] = 'ROLE_SUPERVISOR';
        }
        
        return $roles;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return $this->lettercode;
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

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * @return Collection|StudentGroup[]
     */
    public function getStudentGroups(): Collection
    {
        return $this->studentGroups;
    }

    public function addStudentGroup(StudentGroup $studentGroup): self
    {
        if (!$this->studentGroups->contains($studentGroup)) {
            $this->studentGroups[] = $studentGroup;
            $studentGroup->addSupervisor($this);
        }

        return $this;
    }

    public function removeStudentGroup(StudentGroup $studentGroup): self
    {
        if ($this->studentGroups->removeElement($studentGroup)) {
            $studentGroup->removeSupervisor($this);
        }

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
            $progressMoment->setCoach($this);
        }

        return $this;
    }

    public function removeProgressMoment(ProgressMoment $progressMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->progressMoments->removeElement($progressMoment)) {
            return $this;
        }
        
        if ($progressMoment->getCoach() !== $this) {
            return $this;
        }
        
        $progressMoment->setCoach(null);
        return $this;
    }

    /**
     * @return Collection|UserRole[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(UserRole $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(UserRole $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    public function getPermissions() {
        $_permissions = [];

        foreach($this->getUserRoles() as $userRole) {
            foreach($userRole->getPermissions() as $permission) {
                $_permissions[] = $permission->getName();
            }
        }

        return $_permissions;
    }

    /**
     * @return Collection<int, Challenge>
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenge $challenge): self
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges[] = $challenge;
            $challenge->setAuthor($this);
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->challenges->removeElement($challenge)) {
            return $this;
        }
        
        if ($challenge->getAuthor() !== $this) {
            return $this;
        }
        
        $challenge->setAuthor(null);
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
            $agreement->setAuthor($this);
        }

        return $this;
    }

    public function removeAgreement(Agreement $agreement): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->agreements->removeElement($agreement)) {
            return $this;
        }
        
        if ($agreement->getAuthor() !== $this) {
            return $this;
        }
        
        $agreement->setAuthor(null);
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
            $dCMoment->setCoach($this);
        }

        return $this;
    }

    public function removeDCMoment(DCMoment $dCMoment): self
    {
        // set the owning side to null (unless already changed)
        if (!$this->DCMoments->removeElement($dCMoment)) {
            return $this;
        }
        
        if ($dCMoment->getCoach() !== $this) {
            return $this;
        }
        
        $dCMoment->setCoach(null);
        return $this;
    }

    public function getUserIdentifier(): string {
        return $this->lettercode;
    }
}
