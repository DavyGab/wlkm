<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registre
 *
 * @ORM\Table(name="Registre", indexes={@ORM\Index(name="IDX_20DF2313BECD7491", columns={"Registre_Borne_ID"})})
 * @ORM\Entity
 */
class Registre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Registre_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $registreId;

    /**
     * @var string
     *
     * @ORM\Column(name="Registre_Clé", type="string", length=50, nullable=true)
     */
    private $registreCle;

    /**
     * @var string
     *
     * @ORM\Column(name="Registre_Valeur", type="string", length=50, nullable=true)
     */
    private $registreValeur;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Registre_Borne_ID", referencedColumnName="Borne_ID")
     * })
     */
    private $registreBorne;


}

