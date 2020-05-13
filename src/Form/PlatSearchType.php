<?php

namespace App\Form;

use App\Entity\PlatSearch;
use App\Entity\Ingrediant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlatSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice',IntegerType::class,[
                'required' => false,
                'label'=>false,
                'attr' => [
                    'placeholder' => 'Prix max'
                    ]
            ])
            ->add('ingrediants',EntityType::class,[
                'required' => false,
                'label' => false,
                'class' => Ingrediant::class,
                'choice_label' =>'nom',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlatSearch::class,
            'method'=> 'get',
            'csrf_protection'=>false,
            
            ]);
    }
}
