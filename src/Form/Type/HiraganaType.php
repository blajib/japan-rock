<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class HiraganaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level_choice', ChoiceType::class, [
                'label'   => 'Niveau',
                'attr'    => [
                    'class' => 'js-select-level btn btn-outline-danger',
                ],
                'placeholder' => 'Select',
                'choices' => [
                    'Niveau 1' => 1,
                    'Niveau 2' => 2,
                    'Niveau 3' => 3,
                    'Niveau 4' => 4,
                    'Niveau 5' => 5,
                    'Niveau 6' => 6,
                    'Niveau 7' => 7,
                    'Niveau 8' => 8,
                    'Niveau 9' => 9,
                ],
            ])
            ->add('roomaji_show', CheckboxType::class, [
                'label' => 'Afficher Roomaji',
                'attr'  => [
                    'class' => 'hiragana-checkbox',
                ],
            ])
            ->add('hiragana_show', CheckboxType::class, [
                'label' => 'Afficher Hiragana',
                'attr'  => [
                    'class' => 'hiragana-checkbox',
                ],
            ])
            ->add('hiragana_sound', CheckboxType::class, [
                'label' => 'Prononciation',
                'attr'  => [
                    'class' => 'hiragana-checkbox',
                ],
            ])
            ->add('hiragana_select_group', CheckboxType::class, [
                'label' => 'Uniquement le groupe',
            ])
        ;
    }

}