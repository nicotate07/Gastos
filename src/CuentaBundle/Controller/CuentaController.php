<?php

namespace CuentaBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use CuentaBundle\Entity\Cuenta;
use CuentaBundle\Form\CuentaType;
use FOS\RestBundle\Controller\Annotations as Rest;

class CuentaController extends FOSRestController
{
    /**
     * @Rest\View(serializerGroups={"cuenta"})
     */
    public function getCuentasAction(Request $request)
    {
        $cuentas = $this->getDoctrine()->getRepository('CuentaBundle:Cuenta')->findAll();
        if($cuentas === null) $cuentas = array();

        return array(
            'data' => $cuentas
        );
    }

    /**
     * @Rest\View
     */
    public function getCuentaAction(Request $request, $id)
    {
        $cuenta = $this->getDoctrine()->getRepository('CuentaBundle:Cuenta')->findOneById($id);
        if($cuenta === null) $cuenta = array();

        return array(
            'data' => $cuenta
        );
    }

    /**
     * @Rest\View
     */
    public function postCuentasAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();
        try {
            $cuenta = new Cuenta();
            $form = $this->createForm(CuentaType::class, $cuenta)
                ->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cuenta);
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
    public function postCuentaAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $cuenta = $em->getRepository('CuentaBundle:Cuenta')->find($id);
        if (!$cuenta) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(CuentaType::class, $cuenta)
            ->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cuenta);
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
