<?php

namespace App\Form;

use App\Entity\Jobs;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreajobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category')
            ->add('contrat')
            ->add('entreprise')
            ->add('logo')
            ->add('url')
            ->add('lieu')
            ->add('pays')
            ->add('email',EmailType::class)
            ->add('description')
            ->add('submit', SubmitType::class,[
                'label' => "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jobs::class,
        ]);
    }
}
