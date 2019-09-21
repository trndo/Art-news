<?php

namespace App\Form;

use App\Model\PictureModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'Назва картини'
        ]);
        if (!$options['translation'])
            $builder->add('photo', FileType::class, [
                'attr' => [
                    'class' => 'form-control-file'
                ],
                'label' => 'Титульна фотографiя'
            ]);
        $builder->add('body', TextareaType::class, [
            'attr' => [
                'placeholder' => 'Опис картини'
            ]
        ])
            ->add('locale', TextType::class, [
                'attr' => [
                    'value' => $options['translation'] ? 'EN' : 'UA',
                    'readonly' => true
                ],
                'label' => 'Мова',
            ])
            ->add('photos', CollectionType::class,[
                'entry_type' => PicturePhotoType::class,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add' => true,
                'label' => false
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PictureModel::class,
            'translation' => false
        ]);
    }


}