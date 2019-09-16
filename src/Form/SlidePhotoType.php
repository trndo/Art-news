<?php


namespace App\Form;


use App\Entity\Article;
use App\Entity\Resume;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SlidePhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photo',FileType::class, [
            'label' => 'Фото',
            'multiple' => false,
            'data_class' => null
        ])
            ->add('save',SubmitType::class, [
                'label' => 'Зберегти'
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resume::class
        ]);
    }
}