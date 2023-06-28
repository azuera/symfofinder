<?php

namespace App\Form;

use App\Entity\CharacterSheet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterSheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('race')
            ->add('class')

            ->add('initiative')
            ->add('hpMax')
            ->add('actualHp')
            ->add('mpMax')
            ->add('actualMp')
            ->add('strength')
            ->add('dexterity')
            ->add('stamina')
            ->add('intelligence')
            ->add('wisdom')
            ->add('luck')
                  ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterSheet::class,
        ]);
    }
}
