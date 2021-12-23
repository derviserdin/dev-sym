<?php

namespace App\Form;

use App\Entity\Konferans;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class KonferansType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //istersek  form tipi yerine null bırakarak symfony otomatik type düzelmesini görebiliriz
        $builder
            ->add('isim')
            ->add('afis',FileType::class,[
            'label' => 'Afis (PDF Dosyası)',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Görevi Kaydet',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Konferans::class,
        ]);
    }

}