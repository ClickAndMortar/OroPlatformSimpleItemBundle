<?php

namespace ClickAndMortar\SimpleItemBundle\ImportExport\TemplateFixture;

use ClickAndMortar\SimpleItemBundle\Entity\SimpleItem;
use ClickAndMortar\SimpleItemBundle\Entity\SimpleList;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

/**
 * Simple List fixture
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\ImportExport\TemplateFixture
 */
class SimpleListFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
{
    /**
     * Key of default example entity
     *
     * @var string
     */
    const DEFAULT_EXAMPLE_KEY = 'simplelist-example';

    /**
     * Example items array
     *
     * @var array
     */
    protected $exampleItems = array(
        array(
            'label' => 'My item 01',
            'value' => 'my-item-01',
        ),
        array(
            'label' => 'My item 02',
            'value' => 'my-item-02',
        ),
        array(
            'label' => 'My item 03',
            'value' => 'my-item-03',
        ),
    );

    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return 'ClickAndMortar\SimpleItemBundle\Entity\SimpleList';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->getEntityData(self::DEFAULT_EXAMPLE_KEY);
    }

    /**
     * {@inheritdoc}
     */
    protected function createEntity($key)
    {
        return new SimpleList();
    }

    /**
     * @param string     $key
     * @param SimpleList $entity
     */
    public function fillEntityData($key, $entity)
    {
        $entity
            ->setLabel('My list')
            ->setValue('my-list')
            ->setItems($this->getDefaultItems());

        return;
    }

    /**
     * Get default items
     *
     * @return Collection|SimpleItem[]
     */
    protected function getDefaultItems()
    {
        $items = new ArrayCollection();

        foreach ($this->exampleItems as $exampleItem) {
            $item = new SimpleItem();
            $item->setLabel($exampleItem['label']);
            $item->setValue($exampleItem['value']);
            $items->add($item);
        }

        return $items;
    }
}
