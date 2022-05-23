<?php

namespace App\Domain\Place\Form;

use App\Domain\Place\Entity\Type;
use App\Domain\Place\Enum\Influx;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchPlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'multiple' => true,
                'placeholder' => 'All types',
            ])
            ->add('influx', EnumType::class, [
                'class' => Influx::class,
            ])
            ->add('ratings', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Search',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
