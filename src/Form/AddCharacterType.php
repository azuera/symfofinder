<?php

namespace App\Form;

use App\Entity\CharacterSheet;
use App\Entity\Game;
use App\Repository\CharacterSheetRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   $game = $options['data']->getGame();
        $builder

            ->add('characterSheet',EntityType::class,[
                'class' => CharacterSheet::class,
                'multiple' => true,
                'expanded' => true,
//                'query_builder' => function (CharacterSheetRepository $er) use ($game)  {
//                    return $er->createQueryBuilder('c')
//                        ->andWhere('c.game IS NULL ')
//                        ->orWhere('c.game = :game ')
//                        ->setParameter('game',$game );
//                },
                'choice_label' => 'class',
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
