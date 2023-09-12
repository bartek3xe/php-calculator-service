<?php

namespace App\Form;

use App\DBAL\Type\OperatorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstNumber', NumberType::class, [
                'html5' => true,
            ])
            ->add('secondNumber', NumberType::class, [
                'html5' => true,
            ])
            ->add('operator', ChoiceType::class, [
                'choices' => OperatorType::VALID_OPERATORS,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}