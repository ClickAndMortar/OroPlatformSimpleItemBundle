<?php

namespace ClickAndMortar\SimpleItemBundle\Entity;

use ClickAndMortar\SimpleItemBundle\Model\ExtendSimpleItem;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

/**
 * SimpleItem
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity
 *
 * @ORM\Entity(repositoryClass="ClickAndMortar\SimpleItemBundle\Entity\Repository\SimpleItemRepository")
 * @ORM\Table(name="candm_simpleitem_simpleitem")
 * @Config(
 *     defaultValues={
 *         "dataaudit"={
 *              "auditable"=true
 *         },
 *     }
 * )
 */
class SimpleItem extends ExtendSimpleItem
{
    /**
     * Class name
     *
     * @var string
     */
    const CLASS_NAME = 'ClickAndMortarSimpleItemBundle:SimpleItem';

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
     * @ORM\Column(name="value", type="string")
     * @ConfigField(
     *      defaultValues={
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
     * @ORM\ManyToOne(targetEntity="ClickAndMortar\SimpleItemBundle\Entity\SimpleList", inversedBy="items")
     * @ORM\JoinColumn(name="simplelist_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     *
     * @var SimpleList
     **/
    protected $list;

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
     * @return SimpleItem
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
     * @return SimpleItem
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get list
     *
     * @return SimpleList
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set list
     *
     * @param SimpleList $list
     *
     * @return SimpleItem
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get item label
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getLabel();
    }
}