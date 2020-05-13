<?php

namespace App\Form;

use App\Entity\Senior;
use App\Entity\Ingrediant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SeniorType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail')
            ->add('n_tel')
            ->add('allergies', EntityType::class, [
                'class' => Ingrediant::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'multiple' => true,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Senior::class,
        ]);
    }
}
