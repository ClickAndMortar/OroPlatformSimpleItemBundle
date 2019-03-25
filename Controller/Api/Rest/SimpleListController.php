<?php

namespace ClickAndMortar\SimpleItemBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

/**
 * SimpleList controller
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Controller\Api\Rest
 *
 * @RouteResource("simplelist")
 * @NamePrefix("candm_simpleitem_api_")
 */
class SimpleListController extends RestController
{
    /**
     * Delete action
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * Get form
     */
    public function getForm()
    {
    }

    /**
     * Get form handler
     */
    public function getFormHandler()
    {
    }

    /**
     * @return ApiEntityManager
     */
    public function getManager()
    {
        return $this->get('candm_simpleitem.simplelist.manager.api');
    }
}