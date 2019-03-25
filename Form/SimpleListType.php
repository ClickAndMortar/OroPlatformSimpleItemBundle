<?php

namespace ClickAndMortar\SimpleItemBundle\Form;

use Oro\Bundle\FormBundle\Form\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * SimpleList type
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Form
 */
class SimpleListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, array(
                'required' => true,
                'label'    => 'clickandmortar.simpleitem.simplelist.label.label',
            ))
            ->add('value', TextType::class, array(
                'required' => true,
                'label'    => 'clickandmortar.simpleitem.simplelist.value.label',
            ))
            ->add('items', CollectionType::class, array(
                    'required'             => false,
                    'entry_type'           => SimpleItemType::class,
                    'label'                => 'clickandmortar.simpleitem.simplelist.items.label',
                    'add_label'            => 'clickandmortar.simpleitem.simplelist.custom.actions.add_simpleitem',
                    'show_form_when_empty' => false,
                    'attr'                 => array(
                        'class' => 'clickandmortar-collection',
                    ),
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClickAndMortar\SimpleItemBundle\Entity\SimpleList',
        ));
    }
}