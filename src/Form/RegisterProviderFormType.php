<?php

namespace App\Form;

use App\Entity\Images;
use App\Entity\Locality;
use App\Entity\Provider;
use App\Entity\Services;
use App\Entity\ZipCode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegisterProviderFormType extends AbstractType
{




    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('email', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('email_provider', EmailType::class, array(
                'attr'=> array('class' => 'form-control'),
            ))
            ->add('password', PasswordType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('street', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('number', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('services', EntityType::class, array(
                'placeholder' =>'Services',
                'label' => '',
                'by_reference' => false,
                'class' => Services::class,
                'multiple'=> true,
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
                'placeholder' => 'Localité',
                'label' => 'Localité',
                'class' => Locality::class,
                'multiple'=> false,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('telNumber', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('tvaNumber', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('website', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))

            ->add('logo', ImageType::class)

            ->add('save',SubmitType::class, ['label' => 'Register']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provider::class
        ]);
    }
}
