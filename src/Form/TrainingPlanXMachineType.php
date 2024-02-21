<?php

namespace App\Form;

use App\Entity\Machines;
use App\Entity\TrainingPlan;
use App\Entity\TrainingPlanXMachine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingPlanXMachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('weight')
            ->add('intervals')
            ->add('repetitions')
            ->add('training_plan_id', EntityType::class, [
                'class' => TrainingPlan::class,
'choice_label' => 'name',
            ])
            ->add('machine_id', EntityType::class, [
                'class' => Machines::class,
'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrainingPlanXMachine::class,
        ]);
    }
}
