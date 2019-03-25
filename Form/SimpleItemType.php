<?php

namespace ClickAndMortar\SimpleItemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * SimpleItem type
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Form
 */
class SimpleItemType extends AbstractType
{
    /**
     * Form type name
     *
     * @var string
     */
    const NAME = 'candm_simpleitem_form_type_simpleitem';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label',
                'text',
                [
                    'label'    => 'clickandmortar.simpleitem.label.label',
                    'required' => true,
                ]
            )
            ->add('value',
                'text',
                [
                    'label'    => 'clickandmortar.simpleitem.value.label',
                    'required' => true,
                ]
            )
            ->add(
                'image',
                'oro_file',
                [
                    'label'       => 'clickandmortar.simpleitem.image.label',
                    'required'    => false,
                    'allowDelete' => true,
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClickAndMortar\SimpleItemBundle\Entity\SimpleItem',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}