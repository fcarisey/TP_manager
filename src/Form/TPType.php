<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\TP;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TPType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('fichier', FileType::class, [
                'required' => false
            ])
            ->add('date_debut', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text'
            ])
            ->add('date_fin', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text'
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'designation',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TP::class,
        ]);
    }
}
