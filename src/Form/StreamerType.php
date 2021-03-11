<?php

namespace App\Form;

use App\Entity\Streamer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('twitch', TextType::class)
            ->add('discord', TextType::class)
            ->add('twitter', TextType::class, [
                'required' => false,
            ])
            ->add('snapchat', TextType::class, [
                'required' => false,
            ])
            ->add('instagram', TextType::class, [
                'required' => false,
            ])
            ->add('youtube', TextType::class, [
                'required' => false,
            ])
            ->add('description', TextType::class)
            ->add('donation', TextType::class, [
                'required' => false,
            ])
            ->add('bio', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Streamer::class,
        ]);
    }
}