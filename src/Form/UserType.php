<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom :',
                'attr' => array('class' => 'form-control')
            ])
            ->add('Prenom', TextType::class, array(
                'label' => 'Prenom :',
                'attr' => array('class' => 'form-control')
            ))
            ->add('Matricule', TextType::class, [
                'label' => 'Matricule :',
                'attr' => array('class' => 'form-control')
            ]);

        // $builder->get('roles')
        //         ->addModelTransformer(new CallbackTransformer(
        //             function($rolesArray){
        //                 return count($rolesArray) ? $rolesArray[0] : null;
        //             },
        //             function($rolesString){
        //                 return [$rolesString];
        //             }
        //         ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
