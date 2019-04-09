<?php

namespace EventoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Evento
 *
 * @ORM\Table(name="evento")
 * @ORM\Entity(repositoryClass="EventoBundle\Repository\EventoRepository")
 */
class Evento
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
     * 
     * @Groups({"evento"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime")
     * 
     * @Assert\NotNull()
     * 
     * @Groups({"evento"})
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime")
     * 
     * @Assert\NotNull()
     * 
     * @Groups({"evento"})
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     * 
     * @Assert\NotNull()
     * 
     * @Groups({"evento"})
     */
    private $descripcion;

    //-----------------------------------------------------
    // Relaciones
    //-----------------------------------------------------

    /**
     * @var \UsuarioBundle\Entity\Usuario
     * 
     * @ORM\ManyToOne(targetEntity="\UsuarioBundle\Entity\Usuario", inversedBy="eventos")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * 
     * @Assert\NotNull()
     */
    protected $usuario;

    /**
     * @var ArrayCollection|Ingreso[]
     * 
     * @ORM\OneToMany(targetEntity="\ExtraBundle\Entity\Ingreso", mappedBy="evento", cascade={"persist","remove"})
     * 
     * @Groups({"evento"})
     */
    private $ingresos;

    /**
     * @var ArrayCollection|Egreso[]
     * 
     * @ORM\OneToMany(targetEntity="\ExtraBundle\Entity\Egreso", mappedBy="evento", cascade={"persist","remove"})
     * 
     * @Groups({"evento"})
     */
    private $egresos;

    //-----------------------------------------------------
    // Métodos
    //-----------------------------------------------------

    public function __construct()
    {
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Evento
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Evento
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Evento
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
     * Set usuario
     *
     * @param \UsuarioBundle\Entity\Usuario $usuario
     *
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
