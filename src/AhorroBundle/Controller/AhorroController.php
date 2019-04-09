<?php

namespace AhorroBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use AhorroBundle\Entity\Ahorro;
use AhorroBundle\Form\AhorroType;

class AhorroController extends FOSRestController
{
    /**
     * @Rest\View(serializerGroups={"ahorro"})
     */
    public function getAhorrosAction(Request $request)
    {
        $ahorros = $this->getDoctrine()->getRepository('AhorroBundle:Ahorro')->findAll();
        if($ahorros === null) $ahorros = array();

        return array(
            'data' => $ahorros
        );
    }

    /**
     * @Rest\View
     */
    public function getAhorroAction(Request $request, $id)
    {
        $ahorro = $this->getDoctrine()->getRepository('AhorroBundle:Ahorro')->findOneById($id);
        if($ahorro === null) $ahorro = array();

        return array(
            'data' => $ahorro
        );
    }

    /**
     * @Rest\View
     */
    public function postAhorrosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();
        try {
            $ahorro = new Ahorro();
            $form = $this->createForm(AhorroType::class, $ahorro)
                ->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ahorro);
                $em->flush();
                $view->setStatusCode(201); //Created
                $response = $this->handleView($view);
                return $response;
            }
            $view->setStatusCode(400) //Bad request
                ->setData($form);
            return $this->handleView($view);
        } catch (\Exception $ex) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException($ex->getMessage());
        }
    }

    /**
     * @Rest\View
     */
    public function postAhorroAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $ahorro = $em->getRepository('AhorroBundle:Ahorro')->find($id);
        if (!$ahorro) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(AhorroType::class, $ahorro)
            ->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ahorro);
            $em->flush();

            $view->setStatusCode(200); //Created
            $response = $this->handleView($view);
            return $response;
        }
        $view->setStatusCode(400) //Bad request
            ->setData($form);
        return $this->handleView($view);
    }
}
