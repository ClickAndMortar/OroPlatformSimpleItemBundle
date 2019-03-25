<?php

namespace ClickAndMortar\SimpleItemBundle\Entity\Repository;

use ClickAndMortar\SimpleItemBundle\Entity\SimpleItem;
use Doctrine\ORM\EntityRepository;

/**
 * Simple item repository
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity\Repository
 */
class SimpleItemRepository extends EntityRepository
{
    /**
     * Get items by $listValue
     *
     * @param string        $listValue
     * @param string | null $listItemValue
     *
     * @return SimpleItem[] | SimpleItem
     */
    public function getByListValue($listValue, $listItemValue = null)
    {
        $queryBuilder = $this->createQueryBuilder('si')
                             ->join('si.list', 'sl')
                             ->where('sl.value = :listValue')
                             ->orderBy('si.label', 'ASC')
                             ->setParameter('listValue', $listValue);

        if ($listItemValue !== null) {
            return $queryBuilder->andWhere('si.value = :listItemValue')
                                ->setParameter('listItemValue', $listItemValue)
                                ->setMaxResults(1)
                                ->getQuery()
                                ->getOneOrNullResult();
        }

        return $queryBuilder->getQuery()
                            ->getResult();
    }
}
