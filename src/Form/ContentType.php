<?php


namespace App\Form;


use App\Form\ContentForm\ContentAbstractType;
use App\Model\ContentModel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends ContentAbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('locale', TextType::class, [
            'attr' => [
                'value' => $options['translation'] ? 'EN' : 'UA'
            ],
            'label' => 'Мова',
            'disabled' => true
        ])
            ->add('title',TextType::class)
            ->add('body',TextareaType::class)
            ->add('photo',FileType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContentModel::class,
            'translation' => false
        ]);
    }

}