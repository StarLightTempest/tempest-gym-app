<?php

namespace App\Entity;

use App\Repository\MachinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MachinesRepository::class)]
class Machines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $max_capacity = null;

    #[ORM\Column]
    private ?int $weight_increment = null;

    #[ORM\OneToMany(targetEntity: TrainingPlanXMachine::class, mappedBy: 'machine_id')]
    private Collection $trainingPlanXMachines;

    public function __construct()
    {
        $this->trainingPlanXMachines = new ArrayCollection();
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

    public function getMaxCapacity(): ?int
    {
        return $this->max_capacity;
    }

    public function setMaxCapacity(int $max_capacity): static
    {
        $this->max_capacity = $max_capacity;

        return $this;
    }

    public function getWeightIncrement(): ?int
    {
        return $this->weight_increment;
    }

    public function setWeightIncrement(int $weight_increment): static
    {
        $this->weight_increment = $weight_increment;

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
            $trainingPlanXMachine->setMachineId($this);
        }

        return $this;
    }

    public function removeTrainingPlanXMachine(TrainingPlanXMachine $trainingPlanXMachine): static
    {
        if ($this->trainingPlanXMachines->removeElement($trainingPlanXMachine)) {
            // set the owning side to null (unless already changed)
            if ($trainingPlanXMachine->getMachineId() === $this) {
                $trainingPlanXMachine->setMachineId(null);
            }
        }

        return $this;
    }
}
