<?php

namespace EventoBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use EventoBundle\Entity\Evento;
use EventoBundle\Form\EventoType;

class EventoController extends FOSRestController
{
    /**
     * @Rest\View(serializerGroups={"evento"})
     */
    public function getEventosAction(Request $request)
    {
        $eventos = $this->getDoctrine()->getRepository('EventoBundle:Evento')->findAll();
        if($eventos === null) $eventos = array();

        return array(
            'data' => $eventos
        );
    }

    /**
     * @Rest\View
     */
    public function getEventoAction(Request $request, $id)
    {
        $evento = $this->getDoctrine()->getRepository('EventoBundle:Evento')->findOneById($id);
        if($evento === null) $evento = array();

        return array(
            'data' => $evento
        );
    }

    /**
     * @Rest\View
     */
    public function postEventosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();
        try {
            $evento = new Evento();
            $form = $this->createForm(EventoType::class, $evento)
                ->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($evento);
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
    public function postEventoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $evento = $em->getRepository('EventoBundle:Evento')->find($id);
        if (!$evento) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(EventoType::class, $evento)
            ->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evento);
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
