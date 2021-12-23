<?php

namespace App\Form;

use App\Entity\Gorev;
use App\Entity\Urun;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlanTipleri extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //istersek  form tipi yerine null bırakarak symfony otomatik type düzelmesini görebiliriz
        $builder
            ->add('basic_input', TextType::class)
            ->add('text_area', TextareaType::class)
            ->add('password', PasswordType::class)
            ->add('percent', PercentType::class)
            ->add('range', RangeType::class, array(
                'attr' => array(
                    'min' => 10,
                    'max' => 100,
                )

            ))
            ->add('color', ColorType::class)
            ->add('Choice',ChoiceType::class,[
                'choices' =>[
                    'Derviş','Üveys','Bilal','Şehmus'
                ]
            ])
            //->add('entity-type',EntityType::class,['class'=>Urun::class        ]) ürün klasındaki veileri ekler
            ->add('ulkeler',CountryType::class)
            ->add('dogum_gunu',BirthdayType::class)
            ->add('embedded_form',EmbeedFormType::class)

        ;
    }


}