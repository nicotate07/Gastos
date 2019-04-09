<?php

namespace UsuarioBundle\Controller;

use UsuarioBundle\Entity\Usuario;
use EventoBundle\Entity\Evento;
use AhorroBundle\Entity\Ahorro;
use CuentaBundle\Entity\Cuenta;
use UsuarioBundle\Form\UsuarioType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends FOSRestController
{
    /**
     * @Rest\View(serializerGroups={"usuarios"})
     * 
     */
    public function getUsuariosAction(Request $request)
    {
        $usuarios = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario')->findAll();
        if($usuarios === null) $usuarios = array();

        return array(
            'data' => $usuarios
        );
    }

    /**
     * @Rest\View
     */
    public function getUsuarioAction(Request $request, $id)
    {
        $usuario = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario')->findOneById($id);
        if($usuario === null) $usuario = array();

        return array(
            'data' => $usuario
        );
    }

    /**
     * @Rest\View
     */
    public function postUsuariosAction(){
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();
        try {
            $usuario = new Usuario();
            $form = $this->createForm(UsuarioType::class, $usuario)
                ->handleRequest($request);

            if ($form->isValid()) {
                $usuario->setEnabled(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
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
    public function postUsuarioAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $usuario = $em->getRepository('UsuarioBundle:Usuario')->find($id);
        if (!$usuario) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(UsuarioType::class, $usuario)
            ->handleRequest($request);

        if ($form->isValid()) {
            $password = $form->get('plainPassword')->getData();
            $usuario->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $view->setStatusCode(200); //Created
            $response = $this->handleView($view);
            return $response;
        }
        $view->setStatusCode(400) //Bad request
            ->setData($form);
        return $this->handleView($view);
    }
    
    /**
     * @Rest\View
     */
    public function postContraseniaAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->view();

        $usuario = $em->getRepository('UsuarioBundle:Usuario')->find($id);
        if (!$usuario) {
            $view->setStatusCode(404);
            return $this->handleView($view);
        }

        $form = $this->createForm(ContraseniaType::class, $usuario)
            ->handleRequest($request);

        if ($form->isValid()) {
            $password = $form->get('plainPassword')->getData();
            $usuario->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
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
