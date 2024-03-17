<?php

namespace App\Form;

use App\Entity\Machines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MachinesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('max_capacity')
            ->add('weight_increment')
            ->add('pictureFile', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('Description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Machines::class,
        ]);
    }
}