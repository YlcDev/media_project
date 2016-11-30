<?php

namespace MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AlbumType extends AbstractType
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
        'choices'  => array(
            'Death' => 'Death',
            'Black' => 'Black',
            'Heavy' => 'Heavy',
            ),
                // *this line is important*
                'choices_as_values' => true,
            ))
            ->add('support', ChoiceType::class, array(
                'choices'  => array(
                    ' MP3' => 'MP3',
                    'CD' => 'CD',
                    'BluRay' => 'BluRay',
                ),
                // *this line is important*
                'choices_as_values' => true,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MediaBundle\Entity\Album'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mediabundle_album';
    }


}
