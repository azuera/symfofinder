<?php

namespace App\Form;

use App\Entity\CharacterSheet;
use App\Entity\Equipement;
use App\Entity\Skill;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('skills',CollectionType::class,[
                'entry_type' => SkillType::class,
                'entry_options' => ['label' => false],
                'label' => 'Skills',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,

            ])
            ->add('equipements',CollectionType::class,[
                'entry_type' => EquipementType::class,
                'entry_options' => ['label' => false],
                'label' => 'Equipements',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
                  ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterSheet::class,
        ]);
    }
}
