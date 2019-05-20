<?php

namespace ClickAndMortar\SimpleItemBundle\Entity\Manager;

use ClickAndMortar\SimpleItemBundle\Entity\Repository\SimpleListRepository;
use ClickAndMortar\SimpleItemBundle\Entity\SimpleList;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Simple list manager
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity\Manager
 */
class SimpleListManager
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
     * Get list by value
     *
     * @param string $value
     *
     * @return SimpleList | null
     */
    public function getUniqueByValue($value)
    {
        /** @var SimpleListRepository $repository */
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
