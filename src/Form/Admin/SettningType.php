<?php

namespace App\Form\Admin;

use App\Entity\Admin\Settning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('keywords')
            ->add('company')
            ->add('adress')
            ->add('fax')
            ->add('tele')
            ->add('email')
            ->add('facebook')
            ->add('twitter')
            ->add('instagram')
            ->add('linkedin')
            ->add('smptserver')
            ->add('smtpmail')
            ->add('smtpport')
            ->add('aboutus')
            ->add('contact')
            ->add('referance')
            ->add('created_at')
            ->add('updated_up')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Settning::class,
            'csrf_protection'=>false,
        ]);
    }
}
