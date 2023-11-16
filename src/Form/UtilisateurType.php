<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mot_de_passe', PasswordType::class, [
                'label' => "Mot de passe",
                'hash_property_path' => 'password',
                'mapped' => false,
            ])
            ->add('courriel', EmailType::class)
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Etudiant' => 'Etudiant',
                    'Formateur' => 'Formateur',
                ]
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'designation',
                'required' => false,
                'placeholder' => 'Sélectionnez une classe'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
