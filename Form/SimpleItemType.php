<?php

namespace ClickAndMortar\SimpleItemBundle\Form;

use Oro\Bundle\AttachmentBundle\Form\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                TextType::class,
                [
                    'label'    => 'clickandmortar.simpleitem.label.label',
                    'required' => true,
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