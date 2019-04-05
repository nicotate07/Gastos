<?php

namespace ExtraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EventoBundle\Entity\Evento;
use AhorroBundle\Entity\Ahorro;
use CuentaBundle\Entity\Cuenta;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Egreso
 *
 * @ORM\Table(name="egreso")
 * @ORM\Entity(repositoryClass="ExtraBundle\Repository\EgresoRepository")
 */
class Egreso
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
     * @var float
     *
     * @ORM\Column(name="monto", type="float")
     * @Assert\NotNull()
     */
    private $monto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     * @Assert\NotNull()
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @Assert\NotNull()
     */
    private $descripcion;

    //-----------------------------------------------------
    // Relaciones
    //-----------------------------------------------------

    /**
     * @var \EventoBundle\Entity\Evento
     * 
     * @ORM\ManyToOne(targetEntity="\EventoBundle\Entity\Evento", inversedBy="egresos")
     * @ORM\JoinColumn(name="evento", referencedColumnName="id")
     */
    protected $evento;

    /**
     * @var \AhorroBundle\Entity\Ahorro
     * 
     * @ORM\ManyToOne(targetEntity="\AhorroBundle\Entity\Ahorro", inversedBy="egresos")
     * @ORM\JoinColumn(name="ahorro", referencedColumnName="id")
     */
    protected $ahorro;

    /**
     * @var \CuentaBundle\Entity\Cuenta
     * 
     * @ORM\ManyToOne(targetEntity="\CuentaBundle\Entity\Cuenta", inversedBy="egresos")
     * @ORM\JoinColumn(name="cuenta", referencedColumnName="id")
     */
    protected $cuenta;

    //-----------------------------------------------------
    // Métodos
    //-----------------------------------------------------

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
     * Set monto
     *
     * @param float $monto
     *
     * @return Egreso
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return float
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Egreso
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Egreso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set evento
     *
     * @param \EventoBundle\Entity\Evento $evento
     *
     * @return Egreso
     */
    public function setEvento(\EventoBundle\Entity\Evento $evento = null)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return \EventoBundle\Entity\Evento
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set ahorro
     *
     * @param \AhorroBundle\Entity\Ahorro $ahorro
     *
     * @return Egreso
     */
    public function setAhorro(\AhorroBundle\Entity\Ahorro $ahorro = null)
    {
        $this->ahorro = $ahorro;

        return $this;
    }

    /**
     * Get ahorro
     *
     * @return \AhorroBundle\Entity\Ahorro
     */
    public function getAhorro()
    {
        return $this->ahorro;
    }

    /**
     * Set cuenta
     *
     * @param \CuentaBundle\Entity\Cuenta $cuenta
     *
     * @return Egreso
     */
    public function setCuenta(\CuentaBundle\Entity\Cuenta $cuenta = null)
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    /**
     * Get cuenta
     *
     * @return \CuentaBundle\Entity\Cuenta
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }
}
