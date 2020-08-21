<?php

namespace App\Form\Admin;

use App\Entity\Admin\slids;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class slidsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('links')
            ->add('imgs')
            ->add('header')
            ->add('paragraf')
            ->add('status')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => slids::class,
            'csrf_protection'=>false,

        ]);
    }
}
