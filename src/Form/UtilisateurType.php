<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('motDePasse', PasswordType::class)
            ->add('courriel', EmailType::class)
            ->add('role')
            ->add('classe_id', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'designation',
                'required' => false
            ])
            ->add('taches') // À revoir avec l'état de la complétion de la tache
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
