<?php

namespace ClickAndMortar\SimpleItemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * SimpleList
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="candm_simpleitem_simplelist")
 * @UniqueEntity("value")
 * @Config(
 *     defaultValues={
 *         "dataaudit"={
 *              "auditable"=true
 *         },
 *     }
 * )
 */
class SimpleList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="label", type="string")
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          },
     *          "importexport"={
     *              "order"=100,
     *          }
     *      }
     * )
     *
     * @var string
     */
    protected $label;

    /**
     * @ORM\Column(name="value", type="string",unique=true)
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          },
     *          "importexport"={
     *              "identity"=true,
     *              "order"=110,
     *          }
     *      }
     * )
     *
     * @var string
     */
    protected $value;

    /**
     * @ORM\OneToMany(
     *      targetEntity="ClickAndMortar\SimpleItemBundle\Entity\SimpleItem",
     *      mappedBy="list",
     *      fetch="EXTRA_LAZY",
     *      cascade={"all"},
     *      orphanRemoval=true
     * )
     * @ConfigField(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          },
     *          "importexport"={
     *              "full"=true,
     *              "order"=120,
     *          }
     *      }
     * )
     *
     * @var Collection|SimpleItem[]
     **/
    protected $items;

    /**
     * SimpleList constructor.
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return SimpleList
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return SimpleList
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set items
     *
     *
     * @param Collection|SimpleItem[] $items
     *
     * @return SimpleList
     */
    public function setItems($items)
    {
        $this->items->clear();

        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * Add item
     *
     * @param SimpleItem $item
     *
     * @return SimpleList
     */
    public function addItem(SimpleItem $item)
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setList($this);
        }

        return $this;
    }

    /**
     * Remove item
     *
     * @param SimpleItem $item
     *
     * @return SimpleList
     */
    public function removeItem(SimpleItem $item)
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
        }

        return $this;
    }

    /**
     * Get item
     *
     * @return Collection|SimpleItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}