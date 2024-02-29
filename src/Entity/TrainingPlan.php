<?php

namespace App\Entity;

use App\Repository\TrainingPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingPlanRepository::class)]
class TrainingPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: TrainingPlanXMachine::class, mappedBy: 'training_plan_id')]
    private Collection $trainingPlanXMachines;

    #[ORM\ManyToOne(inversedBy: 'trainingPlans')]
    private ?Person $person_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weekday = null;



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

    /**
     * @return Collection<int, TrainingPlanXMachine>
     */
    public function getTrainingPlanXMachines(): Collection
    {
        return $this->trainingPlanXMachines;
    }

    public function addTrainingPlanXMachine(TrainingPlanXMachine $trainingPlanXMachine): static
    {
        if (!$this->trainingPlanXMachines->contains($trainingPlanXMachine)) {
            $this->trainingPlanXMachines->add($trainingPlanXMachine);
            $trainingPlanXMachine->setTrainingPlanId($this);
        }

        return $this;
    }

    public function removeTrainingPlanXMachine(TrainingPlanXMachine $trainingPlanXMachine): static
    {
        if ($this->trainingPlanXMachines->removeElement($trainingPlanXMachine)) {
            // set the owning side to null (unless already changed)
            if ($trainingPlanXMachine->getTrainingPlanId() === $this) {
                $trainingPlanXMachine->setTrainingPlanId(null);
            }
        }

        return $this;
    }

    public function getPersonId(): ?Person
    {
        return $this->person_id;
    }

    public function setPersonId(?Person $person_id): static
    {
        $this->person_id = $person_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $Description): static
    {
        $this->description = $Description;

        return $this;
    }

    public function getWeekday(): ?string
    {
        return $this->weekday;
    }

    public function setWeekday(?string $Weekday): static
    {
        $this->weekday = $Weekday;

        return $this;
    }
}
