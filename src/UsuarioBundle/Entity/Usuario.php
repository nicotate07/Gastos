<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use EventoBundle\Entity\Evento;
use AhorroBundle\Entity\Ahorro;
use CuentaBundle\Entity\Cuenta;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    //-----------------------------------------------------
    // Atributos
    //-----------------------------------------------------

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Groups({"usuarios"})
     */
    protected $id;

    /**
     * @var string
     * 
     * @Groups({"usuarios"})
     */
    protected $username;

    /**
     * @var string
     * 
     * @Groups({"usuarios"})
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_apellido", type="string", length=255, nullable=true)
     * 
     * @Groups({"usuarios"})
     */
    protected $nombreApellido;
    
    //-----------------------------------------------------
    // Relaciones
    //-----------------------------------------------------

    /**
     * @var ArrayCollection|Evento[]
     * 
     * @ORM\OneToMany(targetEntity="\EventoBundle\Entity\Evento", mappedBy="usuario", cascade={"persist","remove"})
     * 
     */
    private $eventos;

    /**
     * @var ArrayCollection|Ahorro[]
     * 
     * @ORM\OneToMany(targetEntity="\AhorroBundle\Entity\Ahorro", mappedBy="usuario", cascade={"persist","remove"})
     * 
     */
    private $ahorros;

    /**
     * @var ArrayCollection|Cuenta[]
     * 
     * @ORM\OneToMany(targetEntity="\CuentaBundle\Entity\Cuenta", mappedBy="usuario", cascade={"persist","remove"})
     * 
     */
    private $cuentas;

    //-----------------------------------------------------
    // Métodos
    //-----------------------------------------------------

    public function __construct()
    {
        parent::__construct();
        $this->eventos = new ArrayCollection();
        $this->ahorros = new ArrayCollection();
        $this->cuentas = new ArrayCollection();
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

    /**
     * Add evento
     *
     * @param \EventoBundle\Entity\Evento $evento
     *
     * @return Usuario
     */
    public function addEvento(\EventoBundle\Entity\Evento $evento)
    {
        $this->eventos[] = $evento;

        return $this;
    }

    /**
     * Remove evento
     *
     * @param \EventoBundle\Entity\Evento $evento
     */
    public function removeEvento(\EventoBundle\Entity\Evento $evento)
    {
        $this->eventos->removeElement($evento);
    }

    /**
     * Get eventos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventos()
    {
        return $this->eventos->toArray();
    }

    /**
     * Add ahorro
     *
     * @param \AhorroBundle\Entity\Ahorro $ahorro
     *
     * @return Usuario
     */
    public function addAhorro(\AhorroBundle\Entity\Ahorro $ahorro)
    {
        $this->ahorros[] = $ahorro;

        return $this;
    }

    /**
     * Remove ahorro
     *
     * @param \AhorroBundle\Entity\Ahorro $ahorro
     */
    public function removeAhorro(\AhorroBundle\Entity\Ahorro $ahorro)
    {
        $this->ahorros->removeElement($ahorro);
    }

    /**
     * Get ahorros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAhorros()
    {
        return $this->ahorros->toArray();
    }

    /**
     * Add cuenta
     *
     * @param \CuentaBundle\Entity\Cuenta $cuenta
     *
     * @return Usuario
     */
    public function addCuenta(\CuentaBundle\Entity\Cuenta $cuenta)
    {
        $this->cuentas[] = $cuenta;

        return $this;
    }

    /**
     * Remove cuenta
     *
     * @param \CuentaBundle\Entity\Cuenta $cuenta
     */
    public function removeCuenta(\CuentaBundle\Entity\Cuenta $cuenta)
    {
        $this->cuentas->removeElement($cuenta);
    }

    /**
     * Get cuentas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCuentas()
    {
        return $this->cuentas->toArray();
    }
}
