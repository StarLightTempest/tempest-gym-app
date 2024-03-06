<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $height = null;

    #[ORM\OneToMany(targetEntity: TrainingPlan::class, mappedBy: 'user_id')]
    private Collection $trainingPlans;

    #[ORM\OneToMany(targetEntity: WeightHistory::class, mappedBy: 'user_id')]
    private Collection $weightHistories;

    public function __construct()
    {
        $this->trainingPlans = new ArrayCollection();
        $this->weightHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): static
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return Collection<int, TrainingPlan>
     */
    public function getTrainingPlans(): Collection
    {
        return $this->trainingPlans;
    }

    public function addTrainingPlan(TrainingPlan $trainingPlan): static
    {
        if (!$this->trainingPlans->contains($trainingPlan)) {
            $this->trainingPlans->add($trainingPlan);
            $trainingPlan->setUserId($this);
        }

        return $this;
    }

    public function removeTrainingPlan(TrainingPlan $trainingPlan): static
    {
        if ($this->trainingPlans->removeElement($trainingPlan)) {
            // set the owning side to null (unless already changed)
            if ($trainingPlan->getUserId() === $this) {
                $trainingPlan->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WeightHistory>
     */
    public function getWeightHistories(): Collection
    {
        return $this->weightHistories;
    }

    public function addWeightHistory(WeightHistory $weightHistory): static
    {
        if (!$this->weightHistories->contains($weightHistory)) {
            $this->weightHistories->add($weightHistory);
            $weightHistory->setUserId($this);
        }

        return $this;
    }

    public function removeWeightHistory(WeightHistory $weightHistory): static
    {
        if ($this->weightHistories->removeElement($weightHistory)) {
            // set the owning side to null (unless already changed)
            if ($weightHistory->getUserId() === $this) {
                $weightHistory->setUserId(null);
            }
        }

        return $this;
    }
}
