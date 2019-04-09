<?php

namespace AhorroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UsuarioBundle\Entity\Usuario;
use Doctrine\Common\Collections\ArrayCollection;
use ExtraBundle\Entity\Ingreso;
use ExtraBundle\Entity\Egreso;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ahorro
 *
 * @ORM\Table(name="ahorro")
 * @ORM\Entity(repositoryClass="AhorroBundle\Repository\AhorroRepository")
 */
class Ahorro
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
     * @Groups({"ahorro"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime")
     * 
     * @Assert\NotNull()
     * 
     * @Groups({"ahorro"})
     */
    private $fechaInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * 
     * @Assert\NotNull()
     * 
     * @Groups({"ahorro"})
     */
    private $descripcion;

    //-----------------------------------------------------
    // Relaciones
    //-----------------------------------------------------

    /**
     * @var \UsuarioBundle\Entity\Usuario
     * 
     * @ORM\ManyToOne(targetEntity="\UsuarioBundle\Entity\Usuario", inversedBy="ahorros")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * 
     * @Assert\NotNull()
     */
    protected $usuario;

    /**
     * @var ArrayCollection|Ingreso[]
     * 
     * @ORM\OneToMany(targetEntity="\ExtraBundle\Entity\Ingreso", mappedBy="ahorro", cascade={"persist","remove"})
     * 
     * @Groups({"ahorro"})
     */
    private $ingresos;

    /**
     * @var ArrayCollection|Egreso[]
     * 
     * @ORM\OneToMany(targetEntity="\ExtraBundle\Entity\Egreso", mappedBy="ahorro", cascade={"persist","remove"})
     * 
     * @Groups({"ahorro"})
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
     * @return Ahorro
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Ahorro
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
     * @return Ahorro
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
     * @return Ahorro
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
     * @return Ahorro
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
