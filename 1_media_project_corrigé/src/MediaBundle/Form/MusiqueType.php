<?php

namespace MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusiqueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('artiste')
            ->add('genre', ChoiceType::class, array(
                'placeholder' => 'Choississez un genre',
                'choices' => array(
                    'Soul' => 'Soul',
                    'HipHop' => 'HiHop',
                    'Rock' => 'Rock'
                )
            ))
            ->add('support', ChoiceType::class, array(
                'placeholder' => 'Choississez un support',
                'choices' => array(
                    'Vinyl' => 'Vinyl',
                    'CD' => 'CD',
                    'Cassette' => 'Cassette'
                )
            ))
            ->add('file', 'file', array('label' => 'Image de couverture', 'required' => false));
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MediaBundle\Entity\Musique'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mediabundle_musique';
    }


}
