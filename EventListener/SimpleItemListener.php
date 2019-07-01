<?php

namespace ClickAndMortar\SimpleItemBundle\EventListener;

use ClickAndMortar\SimpleItemBundle\Entity\SimpleItem;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Simple item listener
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\EventListener
 */
class SimpleItemListener
{
    /**
     * @var array
     */
    protected static $fromAccents = [
        'à', 'â', 'ä', 'á', 'ã', 'å', 'À', 'Â', 'Ä', 'Á', 'Ã', 'Å', 'æ', 'Æ', 'ç', 'Ç', 'è', 'ê', 'ë', 'é', 'È', 'Ê',
        'Ë', 'É', 'ð', 'Ð', 'ì', 'î', 'ï', 'í', 'Ì', 'Î', 'Ï', 'Í', 'ñ', 'Ñ', 'ò', 'ô', 'ö', 'ó', 'õ', 'ø', 'Ò', 'Ô',
        'Ö', 'Ó', 'Õ', 'Ø', 'œ', 'Œ',
        'ù', 'û', 'ü', 'ú', 'Ù', 'Û', 'Ü', 'Ú', 'ý', 'ÿ', 'Ý', 'Ÿ',
    ];

    /**
     * @var array
     */
    protected static $toAccents = [
        'a', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'A', 'ae', 'AE', 'c', 'C', 'e', 'e', 'e', 'e', 'E', 'E',
        'E', 'E', 'ed', 'ED', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'n', 'N', 'o', 'o', 'o', 'o', 'o', 'o', 'O', 'O',
        'O', 'O', 'O', 'O', 'oe', 'OE',
        'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'Y',
    ];

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var SimpleItem $entity */
        $entity = $args->getEntity();
        if ($entity instanceof SimpleItem) {
            $this->generateValue($entity);
        }
    }

    /**
     * Generate value for given $simpleItem
     *
     * @param SimpleItem $simpleItem
     *
     * @return void
     */
    protected function generateValue(SimpleItem &$simpleItem)
    {
        if (!empty($simpleItem->getValue())) {
            return;
        }

        // Generate formatted value
        $value = str_replace(self::$fromAccents, self::$toAccents, $simpleItem->getLabel());
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9_-]/', '_', $value);
        $originalValue = $value;

        // Check if value already exists
        $hasValidValue = false;
        $index         = 1;
        while ($hasValidValue === false) {
            $sameValueExists = false;
            foreach ($simpleItem->getList()->getItems() as $item) {
                if ($item->getValue() === $value) {
                    $sameValueExists = true;
                }
            }

            if ($sameValueExists) {
                $value = sprintf('%s_%s', $originalValue, $index);
            }

            $hasValidValue = !$sameValueExists;
            $index++;
        }
        $simpleItem->setValue($value);
    }
}
