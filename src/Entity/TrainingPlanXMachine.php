<?php

namespace App\Entity;

use App\Repository\TrainingPlanXMachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingPlanXMachineRepository::class)]
class TrainingPlanXMachine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $weight = null;

    #[ORM\Column]
    private ?int $intervals = null;

    #[ORM\Column]
    private ?int $repetitions = null;

    #[ORM\ManyToOne(inversedBy: 'trainingPlanXMachines')]
    private ?TrainingPlan $training_plan_id = null;

    #[ORM\OneToMany(targetEntity: TrainingExecution::class, mappedBy: 'training_plan_x_machine_id')]
    private Collection $trainingExecutions;

    #[ORM\ManyToOne(inversedBy: 'trainingPlanXMachines')]
    private ?Machines $machine_id = null;

    public function __construct()
    {
        $this->trainingExecutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getIntervals(): ?int
    {
        return $this->intervals;
    }

    public function setIntervals(int $intervals): static
    {
        $this->intervals = $intervals;

        return $this;
    }

    public function getRepetitions(): ?int
    {
        return $this->repetitions;
    }

    public function setRepetitions(int $repetitions): static
    {
        $this->repetitions = $repetitions;

        return $this;
    }

    public function getTrainingPlanId(): ?TrainingPlan
    {
        return $this->training_plan_id;
    }

    public function setTrainingPlanId(?TrainingPlan $training_plan_id): static
    {
        $this->training_plan_id = $training_plan_id;

        return $this;
    }

    /**
     * @return Collection<int, TrainingExecution>
     */
    public function getTrainingExecutions(): Collection
    {
        return $this->trainingExecutions;
    }

    public function addTrainingExecution(TrainingExecution $trainingExecution): static
    {
        if (!$this->trainingExecutions->contains($trainingExecution)) {
            $this->trainingExecutions->add($trainingExecution);
            $trainingExecution->setTrainingPlanXMachineId($this);
        }

        return $this;
    }

    public function removeTrainingExecution(TrainingExecution $trainingExecution): static
    {
        if ($this->trainingExecutions->removeElement($trainingExecution)) {
            // set the owning side to null (unless already changed)
            if ($trainingExecution->getTrainingPlanXMachineId() === $this) {
                $trainingExecution->setTrainingPlanXMachineId(null);
            }
        }

        return $this;
    }

    public function getMachineId(): ?Machines
    {
        return $this->machine_id;
    }

    public function setMachineId(?Machines $machine_id): static
    {
        $this->machine_id = $machine_id;

        return $this;
    }
}
