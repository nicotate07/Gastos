<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     */
    protected $username;

    /**
     * @var string
     *
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_apellido", type="string", length=255, nullable=true)
     */
    protected $nombreApellido;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nombreApellido
     *
     * @param string $nombreApellido
     *
     * @return Usuario
     */
    public function setNombreApellido($nombreApellido)
    {
        $this->nombreApellido = $nombreApellido;

        return $this;
    }

    /**
     * Get nombreApellido
     *
     * @return string
     */
    public function getNombreApellido()
    {
        return $this->nombreApellido;
    }
}
