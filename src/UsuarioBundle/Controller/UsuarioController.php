<?php

namespace UsuarioBundle\Controller;

use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Form\UsuarioType;
use UsuarioBundle\Form\ContraseniaType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function getUsuariosAction(Request $request)
    {
        $username = $request->query->get('username');
        $usuarios = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario')->buscarPorAtributos($username);
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
}
