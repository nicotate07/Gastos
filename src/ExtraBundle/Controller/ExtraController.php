<?php

namespace ExtraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ExtraBundle\Entity\Ingreso;
use ExtraBundle\Entity\Egreso;
use ExtraBundle\Form\IngresoType;
use ExtraBundle\Form\EgresoType;

class ExtraController extends FOSRestController
{

    //-----------------------------------------------------
    // Ingresos
    //-----------------------------------------------------

    /**
     * @Rest\View
     */
    public function getIngresosAction(Request $request)
    {
        $ingreso = $request->query->get('ingreso');
        $ingresos = $this->getDoctrine()->getRepository('ExtraBundle:Ingreso')->buscarPorAtributos($ingreso);
        if($ingresos === null) $ingresos = array();

        return array(
            'data' => $ingresos
        );
    }

    /**
     * @Rest\View
     */
    public function getIngresoAction(Request $request, $id)
    {
        $ingreso = $this->getDoctrine()->getRepository('ExtraBundle:Ingreso')->findOneById($id);
        if($ingreso === null) $ingreso = array();

        return array(
            'data' => $ingreso
        );
    }

    /**
     * @Rest\View
     */
    public function postIngresosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();
        try {
            $ingreso = new Ingreso();
            $form = $this->createForm(IngresoType::class, $ingreso)
                ->handleRequest($request);
            // dump($form);die();
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingreso);
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
    public function postIngresoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $ingreso = $em->getRepository('ExtraBundle:Ingreso')->find($id);
        if (!$ingreso) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(IngresoType::class, $ingreso)
            ->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingreso);
            $em->flush();

            $view->setStatusCode(200); //Created
            $response = $this->handleView($view);
            return $response;
        }
        $view->setStatusCode(400) //Bad request
            ->setData($form);
        return $this->handleView($view);
    }

    //-----------------------------------------------------
    // Egresos
    //-----------------------------------------------------

    /**
     * @Rest\View
     */
    public function getEgresosAction(Request $request)
    {
        $egreso = $request->query->get('egreso');
        $egresos = $this->getDoctrine()->getRepository('ExtraBundle:Egreso')->buscarPorAtributos($egreso);
        if($egresos === null) $egresos = array();

        return array(
            'data' => $egresos
        );
    }

    /**
     * @Rest\View
     */
    public function getEgresoAction(Request $request, $id)
    {
        $egreso = $this->getDoctrine()->getRepository('ExtraBundle:Egreso')->findOneById($id);
        if($egreso === null) $egreso = array();

        return array(
            'data' => $egreso
        );
    }

    /**
     * @Rest\View
     */
    public function postEgresosAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();
        try {
            $egreso = new Egreso();
            $form = $this->createForm(EgresoType::class, $egreso)
                ->handleRequest($request);

            if ($form->isValid()) {
                $egreso->setEnabled(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($egreso);
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
    public function postEgresoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $egreso = $em->getRepository('ExtraBundle:Egreso')->find($id);
        if (!$egreso) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(EgresoType::class, $egreso)
            ->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($egreso);
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
