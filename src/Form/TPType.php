<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\TP;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TPType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('fichier', TextType::class, [
                'required' => false
            ])
            ->add('date_debut', DateTimeType::class, [
                'required' => false
            ])
            ->add('date_fin', DateTimeType::class, [
                'required' => false
            ])
            ->add('classe_id', EntityType::class, [
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
