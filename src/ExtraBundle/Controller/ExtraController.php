<?php

namespace ExtraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ExtraBundle\Entity\Ingreso;
use ExtraBundle\Form\IngresoType;

class ExtraController extends FOSRestController
{
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

    // /**
    //  * @Rest\View
    //  */
    // public function getUsuarioAction(Request $request, $id)
    // {
    //     $usuario = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario')->findOneById($id);
    //     if($usuario === null) $usuario = array();

    //     return array(
    //         'data' => $usuario
    //     );
    // }

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

            if ($form->isValid()) {
                $ingreso->setEnabled(true);
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

    // /**
    //  * @Rest\View
    //  */
    // public function postUsuarioAction(Request $request, $id)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $view = $this->view();

    //     $usuario = $em->getRepository('UsuarioBundle:Usuario')->find($id);
    //     if (!$usuario) {
    //         $view->setStatusCode(404);
    //         return $this->handleView($view);
    //     }

    //     $form = $this->createForm(UsuarioType::class, $usuario)
    //         ->handleRequest($request);

    //     if ($form->isValid()) {
    //         $password = $form->get('plainPassword')->getData();
    //         $usuario->setPassword($password);
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($usuario);
    //         $em->flush();

    //         $view->setStatusCode(200); //Created
    //         $response = $this->handleView($view);
    //         return $response;
    //     }
    //     $view->setStatusCode(400) //Bad request
    //         ->setData($form);
    //     return $this->handleView($view);
    // }
}
