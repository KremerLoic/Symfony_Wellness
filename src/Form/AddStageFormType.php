<?php

namespace App\Form;

use App\Entity\Provider;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddStageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFrom', DateType::class,array(

            ))
            ->add('dateTo', DateType::class, array(

            ))
            ->add('dateStart', DateType::class, array(

            ))
            ->add('description', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('dateEnd', DateType::class, array(

            ))
            ->add('moreInfos', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('price', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('submit', SubmitType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
