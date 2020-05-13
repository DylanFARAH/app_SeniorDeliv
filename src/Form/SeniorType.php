<?php

namespace App\Form;

use App\Entity\Senior;
use App\Entity\Ingrediant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SeniorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('adresse')
            ->add('n_tel')
            ->add('allergies', EntityType::class, [
                'class' => Ingrediant::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'multiple' => true,
                'required'=> false,
            ])
            ->add('actif',ChoiceType::class,[
                'choices' => [
                    'Non' => '0',
                    'Oui' => '1',
                ]
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
