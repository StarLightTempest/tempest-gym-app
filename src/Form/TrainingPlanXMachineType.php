<?php

namespace App\Form;

use App\Entity\Machines;
use App\Entity\TrainingPlan;
use App\Entity\TrainingPlanXMachine;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingPlanXMachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];

        $builder
            ->add('weight')
            ->add('intervals')
            ->add('repetitions')
            ->add('training_plan_id', EntityType::class, [
                'class' => TrainingPlan::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('tp')
                        ->where('tp.user_id = :user')
                        ->setParameter('user', $user);
                },
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
            'user' => null,
        ]);
    }
}