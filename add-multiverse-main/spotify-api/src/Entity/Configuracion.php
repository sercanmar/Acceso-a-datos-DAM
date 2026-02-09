<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Configuracion
 *
 * @ORM\Table(name="configuracion", uniqueConstraints={@ORM\UniqueConstraint(name="usuario_id_UNIQUE", columns={"usuario_id"})}, indexes={@ORM\Index(name="fk_configuracion_idioma1_idx", columns={"idioma_id"}), @ORM\Index(name="fk_configuracion_calidad1_idx", columns={"calidad_id"}), @ORM\Index(name="fk_configuracion_tipo_descarga1_idx", columns={"tipo_descarga_id"})})
 * @ORM\Entity
 *
 */
class Configuracion
{
    /**
     * @var bool
     *
     * @ORM\Column(name="autoplay", type="boolean", nullable=false)
     * @Groups({"usuario:read","configuracion"})
     */
    private $autoplay;

    /**
     * @var bool
     *
     * @ORM\Column(name="ajuste", type="boolean", nullable=false)
     * @Groups({"usuario:read","configuracion"})
     */
    private $ajuste;

    /**
     * @var bool
     *
     * @ORM\Column(name="normalizacion", type="boolean", nullable=false)
     * @Groups({"usuario:read","configuracion"})
     */
    private $normalizacion;

    /**
     * @var Calidad
     *
     * @ORM\ManyToOne(targetEntity="Calidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calidad_id", referencedColumnName="id")
     * })
     * @Groups({"usuario:read","configuracion"})
     */
    private $calidad;

    /**
     * @var TipoDescarga
     *
     * @ORM\ManyToOne(targetEntity="TipoDescarga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_descarga_id", referencedColumnName="id")
     * })
     * @Groups({"usuario:read","configuracion"})
     */
    private $tipoDescarga;

    /**
     * @var Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     * @Groups({"usuario:read"})
     */
    private $usuario;

    /**
     * @var Idioma
     *
     * @ORM\ManyToOne(targetEntity="Idioma")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idioma_id", referencedColumnName="id")
     * })
     * @Groups({"usuario:read","configuracion"})
     */
    private $idioma;

    public function isAutoplay(): bool
    {
        return $this->autoplay;
    }

    public function setAutoplay(bool $autoplay): void
    {
        $this->autoplay = $autoplay;
    }

    /**
     * @return bool
     */
    public function isAjuste(): bool
    {
        return $this->ajuste;
    }

    /**
     * @param bool $ajuste
     */
    public function setAjuste(bool $ajuste): void
    {
        $this->ajuste = $ajuste;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return Idioma
     */
    public function getIdioma(): Idioma
    {
        return $this->idioma;
    }

    /**
     * @param Idioma $idioma
     */
    public function setIdioma(Idioma $idioma): void
    {
        $this->idioma = $idioma;
    }

    /**
     * @return TipoDescarga
     */
    public function getTipoDescarga(): TipoDescarga
    {
        return $this->tipoDescarga;
    }

    /**
     * @param TipoDescarga $tipoDescarga
     */
    public function setTipoDescarga(TipoDescarga $tipoDescarga): void
    {
        $this->tipoDescarga = $tipoDescarga;
    }

    /**
     * @return Calidad
     */
    public function getCalidad(): Calidad
    {
        return $this->calidad;
    }

    /**
     * @param Calidad $calidad
     */
    public function setCalidad(Calidad $calidad): void
    {
        $this->calidad = $calidad;
    }

    /**
     * @return bool
     */
    public function isNormalizacion(): bool
    {
        return $this->normalizacion;
    }

    /**
     * @param bool $normalizacion
     */
    public function setNormalizacion(bool $normalizacion): void
    {
        $this->normalizacion = $normalizacion;
    }


}
