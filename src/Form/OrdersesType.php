<?php

namespace App\Form;

use App\Entity\Orderses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userid')
            ->add('amount')
            ->add('name')
            ->add('address')
            ->add('city')
            ->add('phone')
            ->add('shipinfo')
            ->add('status')
            ->add('note')
            ->add('updated_at')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orderses::class,
        ]);
    }
}
