<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [ 'label' => "Titre de l'article" ])
            ->add('premium', null, [ 'label' => 'Abonné ?'])
            ->add('description')
            ->add('content', null, [ 'label' => 'Contenu'])
            ->add('save', SubmitType::class, ['label' => 'Publier'])
            // ->add('image')
            // ->add('tags')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
