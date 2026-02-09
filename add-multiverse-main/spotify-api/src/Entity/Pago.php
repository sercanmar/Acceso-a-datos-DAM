<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Pago
 *
 * @ORM\Table(name="pago", uniqueConstraints={@ORM\UniqueConstraint(name="suscripcion_id_UNIQUE", columns={"suscripcion_id"})}, indexes={@ORM\Index(name="fk_pago_forma_pago1_idx", columns={"forma_pago_id"}), @ORM\Index(name="fecha_idx", columns={"fecha"})})
 * @ORM\Entity
 */
class Pago
{
    /**
     * @var int
     *
     * @ORM\Column(name="numero_orden", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"usuario:read"})
     */
    private $numeroOrden;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     * @Groups({"usuario:read"})
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=false)
     * @Groups({"usuario:read"})
     */
    private $total;

    /**
     * @var FormaPago
     *
     * @ORM\ManyToOne(targetEntity="FormaPago")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="forma_pago_id", referencedColumnName="id")
     * })
     * @Groups({"usuario:read"})
     */
    private $formaPago;

    /**
     * @var Suscripcion
     *
     * @ORM\ManyToOne(targetEntity="Suscripcion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="suscripcion_id", referencedColumnName="id")
     * })
     * @Groups({"usuario:read"})
     */
    private $suscripcion;

    public function getNumeroOrden(): int
    {
        return $this->numeroOrden;
    }

    public function setNumeroOrden(int $numeroOrden): void
    {
        $this->numeroOrden = $numeroOrden;
    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return Suscripcion
     */
    public function getSuscripcion(): Suscripcion
    {
        return $this->suscripcion;
    }

    /**
     * @param Suscripcion $suscripcion
     */
    public function setSuscripcion(Suscripcion $suscripcion): void
    {
        $this->suscripcion = $suscripcion;
    }

    /**
     * @return FormaPago
     */
    public function getFormaPago(): FormaPago
    {
        return $this->formaPago;
    }

    /**
     * @param FormaPago $formaPago
     */
    public function setFormaPago(FormaPago $formaPago): void
    {
        $this->formaPago = $formaPago;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }


}
