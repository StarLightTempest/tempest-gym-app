<?php

namespace App\Entity;

use App\Repository\TrainingExecutionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingExecutionRepository::class)]
class TrainingExecution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'trainingExecutions')]
    private ?TrainingPlanXMachine $training_plan_x_machine_id = null;

    #[ORM\Column]
    private ?bool $completed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTrainingPlanXMachineId(): ?TrainingPlanXMachine
    {
        return $this->training_plan_x_machine_id;
    }

    public function setTrainingPlanXMachineId(?TrainingPlanXMachine $training_plan_x_machine_id): static
    {
        $this->training_plan_x_machine_id = $training_plan_x_machine_id;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): static
    {
        $this->completed = $completed;

        return $this;
    }
}
