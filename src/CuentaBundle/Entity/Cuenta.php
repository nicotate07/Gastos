<?php

namespace CuentaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UsuarioBundle\Entity\Usuario;
use Doctrine\Common\Collections\ArrayCollection;
use ExtraBundle\Entity\Ingreso;
use ExtraBundle\Entity\Egreso;

/**
 * Cuenta
 *
 * @ORM\Table(name="cuenta")
 * @ORM\Entity(repositoryClass="CuentaBundle\Repository\CuentaRepository")
 */
class Cuenta
{
    //-----------------------------------------------------
    // Atributos
    //-----------------------------------------------------

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_cuenta", type="string", length=255)
     */
    private $nombreCuenta;

    //-----------------------------------------------------
    // Relaciones
    //-----------------------------------------------------

    /**
     * @var \UsuarioBundle\Entity\Usuario
     * 
     * @ORM\ManyToOne(targetEntity="\UsuarioBundle\Entity\Usuario", inversedBy="cuentas")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     */
    protected $usuario;

    /**
     * @var ArrayCollection|Ingreso[]
     * 
     * @ORM\OneToMany(targetEntity="\ExtraBundle\Entity\Ingreso", mappedBy="cuenta", cascade={"persist","remove"})
     * 
     */
    private $ingresos;

    /**
     * @var ArrayCollection|Egreso[]
     * 
     * @ORM\OneToMany(targetEntity="\ExtraBundle\Entity\Egreso", mappedBy="cuenta", cascade={"persist","remove"})
     * 
     */
    private $egresos;

    //-----------------------------------------------------
    // Métodos
    //-----------------------------------------------------

    public function __construct()
    {
        parent::__construct();
        $this->ingresos = new ArrayCollection();
        $this->egresos = new ArrayCollection();
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Cuenta
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set nombreCuenta
     *
     * @param string $nombreCuenta
     *
     * @return Cuenta
     */
    public function setNombreCuenta($nombreCuenta)
    {
        $this->nombreCuenta = $nombreCuenta;

        return $this;
    }

    /**
     * Get nombreCuenta
     *
     * @return string
     */
    public function getNombreCuenta()
    {
        return $this->nombreCuenta;
    }

    /**
     * Set usuario
     *
     * @param \UsuarioBundle\Entity\Usuario $usuario
     *
     * @return Cuenta
     */
    public function setUsuario(\UsuarioBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \UsuarioBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add ingreso
     *
     * @param \ExtraBundle\Entity\Ingreso $ingreso
     *
     * @return Cuenta
     */
    public function addIngreso(\ExtraBundle\Entity\Ingreso $ingreso)
    {
        $this->ingresos[] = $ingreso;

        return $this;
    }

    /**
     * Remove ingreso
     *
     * @param \ExtraBundle\Entity\Ingreso $ingreso
     */
    public function removeIngreso(\ExtraBundle\Entity\Ingreso $ingreso)
    {
        $this->ingresos->removeElement($ingreso);
    }

    /**
     * Get ingresos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngresos()
    {
        return $this->ingresos->toArray();
    }

    /**
     * Add egreso
     *
     * @param \ExtraBundle\Entity\Egreso $egreso
     *
     * @return Cuenta
     */
    public function addEgreso(\ExtraBundle\Entity\Egreso $egreso)
    {
        $this->egresos[] = $egreso;

        return $this;
    }

    /**
     * Remove egreso
     *
     * @param \ExtraBundle\Entity\Egreso $egreso
     */
    public function removeEgreso(\ExtraBundle\Entity\Egreso $egreso)
    {
        $this->egresos->removeElement($egreso);
    }

    /**
     * Get egresos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEgresos()
    {
        return $this->egresos->toArray();
    }
}
