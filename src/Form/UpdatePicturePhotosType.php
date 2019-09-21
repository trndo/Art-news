<?php


namespace App\Form;


use App\Entity\Picture;
use App\Model\UpdatePictureModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdatePicturePhotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photo', FileType::class, [
            'label' => 'Титульна фотографія',
            'multiple' => false,
            'data_class' => null
        ])
            ->add('photos', CollectionType::class, [
                'entry_type' => UpdateAdditionalPicturesType::class,
                'entry_options' => [
                    'label' => false
                ],
                'data_class' => null,
                'label' => false
            ])
            ->add('save',SubmitType::class, [
                'label' => 'Зберегти'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdatePictureModel::class,
        ]);
    }

}