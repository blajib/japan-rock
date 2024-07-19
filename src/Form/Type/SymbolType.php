<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Repository\SymbolRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SymbolType extends AbstractType
{
    public function __construct(
        private readonly SymbolRepository $symbolRepository
    ) {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'symbol_type' => null,
        ]);
    }

    private function getLevelChoice(string $type): array
    {
        $choices = $this->symbolRepository->findLevelChoices($type);

        $formatChoices = [];

        foreach ($choices as $element) {
            $formatChoices[] = $element["level"];
        }

        return $formatChoices;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level_choice', ChoiceType::class, [
                'label'        => 'Niveau',
                'attr'         => [
                    'class'                   => 'js-select-level btn btn-outline-light',
                    'data-symbol-game-target' => 'levelChoice',
                ],
                'placeholder'  => 'Select',
                'choices'      => $this->getLevelChoice($options['symbol_type']),
                'choice_label' => function ($choice) {
                    return 'Level - ' . $choice;
                },
            ])
            ->add('roomaji_show', CheckboxType::class, [
                'label' => 'Afficher Roomaji',
                'attr'  => [
                    'class' => 'symbol-checkbox',
                    'data-symbol-game-target' => 'roomajiShowCheckbox',
                ],
            ])
            ->add('symbol_show', CheckboxType::class, [
                'label' => 'Afficher Hiragana',
                'attr'  => [
                    'class' => 'symbol-checkbox',
                    'data-symbol-game-target' => 'symbolShowCheckbox',
                ],
            ])
            ->add('symbol_sound', CheckboxType::class, [
                'label' => 'Prononciation',
                'attr'  => [
                    'class' => 'symbol-checkbox',
                    'data-symbol-game-target' => 'soundCheckbox',
                ],
            ])
            ->add('symbol_select_group', CheckboxType::class, [
                'label' => 'Uniquement le groupe',
                'attr'  => [
                    'data-symbol-game-target' => 'groupCheckbox',
                ],
            ])
            ->add('symbol_choice', ChoiceType::class, [
                'choices' => [
                    'hiragana' => 'hiragana',
                    'katakana' => 'katakana',
                ],
                'data'    => 'hiragana',
                'attr' => [
                    'data-symbol-game-target' => 'symbolChoice',
                ]
            ])
        ;
    }
}