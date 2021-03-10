<?php

namespace App\Form;

use App\Entity\Streamer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('twitch')
            ->add('discord')
            ->add('twitter')
            ->add('snapchat')
            ->add('instagram')
            ->add('youtube')
            ->add('description')
            ->add('donation')
            ->add('bio')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Streamer::class,
        ]);
    }
}
