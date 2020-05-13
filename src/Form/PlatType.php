<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\Ingrediant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')            
            ->add('ingrediants', EntityType::class, [
                'class' => Ingrediant::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'multiple' => true,
            ])
            //->add('ingredient')
            ->add('prix')            
            ->add('type',ChoiceType::class,[
                'choices' => [
                    'Entrée' => '0',
                    'Plat' => '1',
                    'Dessert' => '2'
                ]
            ])
            ->add('date_debut')
            ->add('date_fin')

            ->add('imageFile',FileType::class, [
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
