<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class HiraganaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('level_choice', ChoiceType::class, [
                'label'   => 'Sélectionner le niveau d\'apprentissage des hiraganas',
                'attr'    => [
                    'class' => 'js-select-level',
                ],
                'choices' => [
                    'Level 1' => 1,
                    'Level 2' => 2,
                    'Level 3' => 3,
                    'Level 4' => 4,
                    'Level 5' => 5,
                    'Level 6' => 6,
                    'Level 7' => 7,
                    'Level 8' => 8,
                    'Level 9' => 9,
                ],
            ])
            ->add('roomaji_show', CheckboxType::class,[
                'label' => 'Afficher Roomaji'
            ])
            ->add('hiragana_show', CheckboxType::class,[
                'label' => 'Afficher Hiragana'
            ])
            ->add('hiragana_sound', CheckboxType::class,[
                'label' => 'Écouter la prononciation'
            ])
        ;
    }

}