<?php

namespace App\Form;

use App\Entity\Project;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', null, [
                'label' => 'Votre client'
            ])
            ->add('year', DateType::class, [
                'label' => 'Date du projet',
                'widget' => 'single_text',
            ])
            ->add('active', null, [
                'label' => 'Affichage sur le site',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('title', null, [
                'label' => 'Nom du projet',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Descriptif'
            ])
            ->add('location', null, [
                'label' => 'Lieu'
            ])
            ->add('category', null, [
                'label' => 'Catégorie',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('image')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
