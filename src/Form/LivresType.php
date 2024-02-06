<?php

namespace App\Form;

use App\Entity\Livres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LivresType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ISBN')
            ->add('Titre_livre')
            ->add('Theme_livre')
            ->add('Nbr_pages_livre')
            ->add('Format_livre')
            ->add('Nom_auteur')
            ->add('Prenom_auteur')
            ->add('Editeur')
            ->add('Annee_edition')
            ->add('Prix_vente')
            ->add('Langue_livre')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livres::class,
        ]);
        
    }
}
