<?php

namespace App\Form;

use App\Entity\Propertysearch;
use App\Entity\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertysearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice',IntegerType ::class,[
             
                'label'=>false,
                'attr'=>[
                    'placeholder'=> 'budjet maximum'
                ]
            ])
            ->add('options', EntityType::class,[
                'class'=> Option::class,
                'choice_label'=> 'name',
                'multiple' => true
              ])
            ->add('minSurface',IntegerType ::class,[
                
                'label'=> false,
                'attr' => [
                    'placeholder' => 'surface minimale'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Propertysearch::class,
            'method' => 'get',
            'csrf_protection'=> false
        ]);
    }
    public function getBlockPrefix()
    {
        return "";
    }
}
