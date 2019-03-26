<?php

namespace ClickAndMortar\SimpleItemBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ClickAndMortar\SimpleItemBundle\Entity\SimpleList;
use ClickAndMortar\SimpleItemBundle\Entity\SimpleItem;

/**
 * Abstract migration that can be used to load simple items for many entities
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Migrations\Data\ORM
 */
abstract class LoadAbstractSimpleItems implements FixtureInterface
{
    /**
     * Load structure
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $simpleListRepository = $manager->getRepository('ClickAndMortarSimpleItemBundle:SimpleList');
        $simpleItemRepository = $manager->getRepository('ClickAndMortarSimpleItemBundle:SimpleItem');

        foreach ($this->getLists() as $list) {
            // Create list
            /** @var SimpleList $simpleList */
            $simpleList = $simpleListRepository->findOneBy(array('value' => $list['value']));
            if (is_null($simpleList)) {
                $simpleList = new SimpleList();
            }
            $simpleList->setLabel($list['label']);
            $simpleList->setValue($list['value']);

            // Create items
            foreach ($list['items'] as $item) {
                /** @var SimpleItem $simpleItem */
                $simpleItem = $simpleItemRepository->findOneBy(array(
                    'list'  => $simpleList,
                    'value' => $item['value'],
                ));
                if (is_null($simpleItem)) {
                    $simpleItem = new SimpleItem();
                    $simpleItem->setList($simpleList);
                }
                $simpleItem->setLabel($item['label']);
                $simpleItem->setValue($item['value']);
                $manager->persist($simpleItem);
            }
            $manager->persist($simpleList);
        }

        $manager->flush();
    }

    /**
     * Get lists as array
     *
     * @return array
     */
    abstract public function getLists();
}