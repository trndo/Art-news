<?php

namespace App\Form;

use App\Model\PictureModel;
use Symfony\Component\Form\AbstractType;
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
        $builder->add('title',TextType::class)
            ->add('photo',FileType::class, [
                'attr' => [
                    'class' => 'form-control-file'
                ],
                'label' => 'Титульна фотографiя'
            ])
            ->add('body',TextareaType::class)
            ->add('locale',TextType::class,[
            'attr' => [
                'value' => $options['translation'] ? 'EN' : 'UA'
            ],
            'label' => 'Мова',
            'disabled' => true
        ])
            ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PictureModel::class,
            'translation' => false
        ]);
    }


}