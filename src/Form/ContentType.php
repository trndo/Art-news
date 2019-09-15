<?php


namespace App\Form;


use App\Model\ContentModel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
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
            ->add('title',TextType::class,[
                'label' => 'Заголовок'
            ])
            ->add('body',TextareaType::class,[
                'label' => 'Зміст'
            ])
            ->add('photo',FileType::class,[
                'label' => 'Фото'
            ])
            ->add('save',SubmitType::class,[
                'label' => 'Зберегти'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContentModel::class,
            'translation' => false
        ]);
    }

}