<?php

namespace App\Form;

use App\Entity\Chantier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom :',
                'attr' => array('class' => 'form-control')
            ])
            ->add('Adresse', TextareaType::class, [
                'label' => 'Adresse :',
                'attr' => array('class' => 'form-control')
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début :',
                'attr' => array('class' => 'form-control')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chantier::class,
        ]);
    }
}
