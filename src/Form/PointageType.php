<?php

namespace App\Form;

use DateTime;
use App\Entity\User;
use App\Entity\Chantier;
use App\Entity\Pointage;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_pointage', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de pointage :',
                'attr' => array('class' => 'form-control')
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée ( par heures ) :',
                'attr' => array('class' => 'form-control')
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'label' => 'Employé :',
                'choice_label' => function ($user) {
                    if( $user->getRoles() !== 'ROLE_ADMIN'){
                        return $user->getNom() . " ". $user->getPrenom();
                    }
                },
                'required' => false,
                'attr' => array('class' => 'form-control', 'onchange' => 'verifierEmploye(this)')
            ])
            ->add('chantier', EntityType::class, [
                'class' => Chantier::class,
                'label' => 'Chantier :',
                'choice_label' => function ($chantier) {
                    
                    return $chantier->getNom();
                },
                'attr' => array('class' => 'form-control' , 'required' => true )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class
        ]);
    }
}
