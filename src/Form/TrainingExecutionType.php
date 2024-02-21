<?php

namespace App\Form;

use App\Entity\TrainingExecution;
use App\Entity\TrainingPlanXMachine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingExecutionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('completed')
            ->add('training_plan_x_machine_id', EntityType::class, [
                'class' => TrainingPlanXMachine::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrainingExecution::class,
        ]);
    }
}
