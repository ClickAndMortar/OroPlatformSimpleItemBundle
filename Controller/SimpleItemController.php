<?php

namespace ClickAndMortar\SimpleItemBundle\Controller;

use ClickAndMortar\SimpleItemBundle\Entity\SimpleItem;
use ClickAndMortar\SimpleItemBundle\Form\SimpleItemType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Oro\Bundle\UIBundle\Route\Router;
use Oro\Bundle\TranslationBundle\Translation\Translator;


/**
 * SimpleItem controller
 *
 * @author  Simon CARRE <simon.carre@clickandmortar.fr>
 * @package ClickAndMortar\SimpleItemBundle\Entity
 *
 * @Route("/simpleitem")
 */
class SimpleItemController extends Controller
{
    /**
     * Index action
     *
     * @return array
     *
     * @Route("/", name="candm_simpleitem_simpleitem_index")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * Create action
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @Route("/create", name="candm_simpleitem_simpleitem_create")
     * @Template("ClickAndMortarSimpleItemBundle:SimpleItem:update.html.twig")
     */
    public function createAction(Request $request)
    {
        return $this->update(new SimpleItem(), $request);
    }

    /**
     * Edit action
     *
     * @param SimpleItem $simpleItem
     * @param Request    $request
     *
     * @return mixed
     *
     * @Route("/edit/{id}", name="candm_simpleitem_simpleitem_update", requirements={"id"="\d+"})
     * @Template("ClickAndMortarSimpleItemBundle:SimpleItem:update.html.twig")
     */
    public function editAction(SimpleItem $simpleItem, Request $request)
    {
        return $this->update($simpleItem, $request);
    }

    /**
     * Update simpleItem
     *
     * @param SimpleItem $simpleItem
     * @param Request    $request
     *
     * @return array
     */
    protected function update(SimpleItem $simpleItem, Request $request)
    {
        $form = $this->createForm(new SimpleItemType(), $simpleItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($simpleItem);
            $entityManager->flush();

            if ($request->get(Router::ACTION_PARAMETER) == Router::ACTION_SAVE_CLOSE) {
                return $this->get('oro_ui.router')->redirectAfterSave(
                    array(),
                    array(
                        'route'      => 'candm_simpleitem_simplelist_view',
                        'parameters' => [
                            'id' => $simpleItem->getList()->getId(),
                        ],
                    ),
                    $simpleItem
                );
            }

            /** @var Translator $translator */
            $translator = $this->get('translator');
            $this->get('session')->getFlashBag()
                 ->add('success', $translator->trans('Saved'));
        }

        return array(
            'entity' => $simpleItem,
            'form'   => $form->createView(),
        );
    }
}