<?php

namespace UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        return array(
            'data' => $usuarios
        );
    }
}
