<?php

namespace ClickAndMortar\SimpleItemBundle\Entity\Manager;

use ClickAndMortar\SimpleItemBundle\Entity\Repository\SimpleItemRepository;
use ClickAndMortar\SimpleItemBundle\Entity\SimpleItem;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Simple item manager
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity\Manager
 */
class SimpleItemManager
{
    /**
     * Class name
     *
     * @var string
     */
    protected $class;

    /**
     * Storage manager
     *
     * @var ObjectManager
     */
    protected $om;

    /**
     * Constructor
     *
     * @param string        $class Entity name
     * @param ObjectManager $om    Object manager
     */
    public function __construct($class, ObjectManager $om)
    {
        $metadata    = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
        $this->om    = $om;
    }

    /**
     * Get items by $listValue
     *
     * @param string $listValue
     *
     * @return SimpleItem[]
     */
    public function getByListValue($listValue)
    {
        /** @var SimpleItemRepository $repository */
        $repository = $this->getRepository();

        return $repository->getByListValue($listValue);
    }

    /**
     * Get unique by $listValue and $itemValue
     *
     * @param string $listValue
     * @param string $itemValue
     *
     * @return SimpleItem
     */
    public function getUniqueByListValueAndItemValue($listValue, $itemValue)
    {
        /** @var SimpleItemRepository $repository */
        $repository = $this->getRepository();

        return $repository->getByListValue($listValue, $itemValue);
    }

    /**
     * Get item by value
     *
     * @param string $value
     *
     * @return SimpleItem | null
     */
    public function getUniqueByValue($value)
    {
        /** @var SimpleItemRepository $repository */
        $repository = $this->getRepository();

        return $repository->findOneBy(array('value' => $value));
    }

    /**
     * Return related repository
     *
     * @return ObjectRepository
     */
    public function getRepository()
    {
        return $this->getStorageManager()->getRepository($this->getClass());
    }

    /**
     * Returns the address's fully qualified class name.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Retrieve object manager
     *
     * @return ObjectManager
     */
    public function getStorageManager()
    {
        return $this->om;
    }
}
