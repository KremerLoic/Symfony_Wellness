<?php

namespace App\Form;

use App\Entity\Locality;
use App\Entity\Surfer;


use App\Entity\ZipCode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterSurferFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('newsletter', ChoiceType::class, array(
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'attr' => array('class' => 'form-control'),

            ))
            ->add('email', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('password', PasswordType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('street', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('number', NumberType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('locality', EntityType::class, array(
                'attr' => array('class' => 'form-control'),
                'placeholder' => 'Localité',
                'label' => 'Localité',
                'class' => Locality::class,
                'multiple'=> false,
            ))
            ->add('zip_code', EntityType::class, array(
                'attr' => array('class' => 'form-control'),
                'placeholder' => 'Code Postal',
                'label' => 'Code Postal',
                'class' => ZipCode::class,
                'multiple'=> false,
            ))



        ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Surfer::class,
        ]);
    }
}
