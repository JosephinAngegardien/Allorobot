<?php

namespace App\Form;

use App\Entity\Robots;
use App\Form\AvisFormType;
use App\Form\ImagesFormType;
use App\Form\CaracTechFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RobotsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modele', TextType::class)
            ->add('tarif', MoneyType::class)
            ->add('description', TextType::class)
            ->add('locomotion',ChoiceType::class, ["choices"=>["Bipède"=>"bip", "Quadrupède"=>"quadr", "Insectoïde"=>"insect"], "expanded"=>true])
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImagesFormType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
            ->add(
                'lesavis',
                CollectionType::class,
                [
                    'entry_type' => AvisFormType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
            ->add(
                'caracs',
                CollectionType::class,
                [
                    'entry_type' => CaracTechFormType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Robots::class,
        ]);
    }
}
