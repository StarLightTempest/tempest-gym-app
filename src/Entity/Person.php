<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $height = null;

    #[ORM\OneToMany(targetEntity: WeightHistory::class, mappedBy: 'person_id')]
    private Collection $weightHistories;

    #[ORM\OneToMany(targetEntity: TrainingPlan::class, mappedBy: 'person_id')]
    private Collection $trainingPlans;

    public function __construct()
    {
        $this->weightHistories = new ArrayCollection();
        $this->trainingPlans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $weightHistory->setPersonId($this);
        }

        return $this;
    }

    public function removeWeightHistory(WeightHistory $weightHistory): static
    {
        if ($this->weightHistories->removeElement($weightHistory)) {
            // set the owning side to null (unless already changed)
            if ($weightHistory->getPersonId() === $this) {
                $weightHistory->setPersonId(null);
            }
        }

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
            $trainingPlan->setPersonId($this);
        }

        return $this;
    }

    public function removeTrainingPlan(TrainingPlan $trainingPlan): static
    {
        if ($this->trainingPlans->removeElement($trainingPlan)) {
            // set the owning side to null (unless already changed)
            if ($trainingPlan->getPersonId() === $this) {
                $trainingPlan->setPersonId(null);
            }
        }

        return $this;
    }
}
