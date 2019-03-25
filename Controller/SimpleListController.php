<?php

namespace ClickAndMortar\SimpleItemBundle\Controller;

use ClickAndMortar\SimpleItemBundle\Entity\SimpleList;
use ClickAndMortar\SimpleItemBundle\Form\SimpleListType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * SimpleList controller
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity
 *
 * @Route("/simplelist")
 */
class SimpleListController extends Controller
{
    /**
     * Index action
     *
     * @return array
     *
     * @Route("/", name="candm_simpleitem_simplelist_index")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'entity_class' => $this->container->getParameter('candm_simpleitem.simplelist.entity.class'),
        ];
    }

    /**
     * View action
     *
     * @param SimpleList $simpleList
     *
     * @return array
     *
     * @Route("/view/{id}", name="candm_simpleitem_simplelist_view", requirements={"id"="\d+"})
     * @Template()
     */
    public function viewAction(SimpleList $simpleList)
    {
        return [
            'entity' => $simpleList,
        ];
    }

    /**
     * Create action
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @Route("/create", name="candm_simpleitem_simplelist_create")
     * @Template("ClickAndMortarSimpleItemBundle:SimpleList:update.html.twig")
     */
    public function createAction(Request $request)
    {
        return $this->update(new SimpleList(), $request);
    }

    /**
     * Edit action
     *
     * @param SimpleList $simpleList
     * @param Request    $request
     *
     * @return mixed
     *
     * @Route("/edit/{id}", name="candm_simpleitem_simplelist_update", requirements={"id"="\d+"})
     * @Template("ClickAndMortarSimpleItemBundle:SimpleList:update.html.twig")
     */
    public function editAction(SimpleList $simpleList, Request $request)
    {
        return $this->update($simpleList, $request);
    }

    /**
     * Update simpleList
     *
     * @param SimpleList $simpleList
     * @param Request    $request
     *
     * @return array
     */
    protected function update(SimpleList $simpleList, Request $request)
    {
        $form = $this->createForm(new SimpleListType(), $simpleList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($simpleList);
            $entityManager->flush();

            return $this->get('oro_ui.router')->redirectAfterSave(
                array(
                    'route'      => 'candm_simpleitem_simplelist_index',
                    'parameters' => array('id' => $simpleList->getId()),
                ),
                array('route' => 'candm_simpleitem_simplelist_index'),
                $simpleList
            );
        }

        return array(
            'entity' => $simpleList,
            'form'   => $form->createView(),
        );
    }
}