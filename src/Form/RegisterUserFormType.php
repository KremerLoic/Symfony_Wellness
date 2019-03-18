<?php

namespace App\Form;

use App\Entity\Locality;
use App\Entity\User;
use App\Entity\ZipCode;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number',TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('street', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))

            ->add('email', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('password', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('zipCode', EntityType::class, array(
                'placeholder' =>'Code Postal',
                'label' => 'Code Postal',
                'class' => ZipCode::class,
                'multiple'=> false,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('locality', EntityType::class, array(
                'attr' => array('class' => 'form-control'),
                'placeholder' => 'Localité',
                'label' => 'Localité',
                'class' => Locality::class,
                'multiple'=> false,
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
