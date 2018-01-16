<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnuaireBorne
 *
 * @ORM\Table(name="Annuaire_Borne")
 * @ORM\Entity
 */
class AnnuaireBorne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Annuaire_Borne_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Annuaire", inversedBy="annuaireBorne")
     * @ORM\JoinColumn(name="Annuaire_Borne_Annuaire_ID", referencedColumnName="Annuaire_ID")
     */
    private $annuaire;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne", inversedBy="annuaireBorne")
     * @ORM\JoinColumn(name="Annuaire_Borne_Borne_ID", referencedColumnName="Borne_ID")
     */
    private $borne;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annuaire_Borne_Distance", type="integer", nullable=false)
     */
    private $distance;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annuaire_Borne_In_Front", type="integer", nullable=false)
     */
    private $inFront;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param int $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getAnnuaire()
    {
        return $this->annuaire;
    }

    /**
     * @param mixed $annuaire
     */
    public function setAnnuaire($annuaire)
    {
        $this->annuaire = $annuaire;
    }

    /**
     * @return mixed
     */
    public function getBorne()
    {
        return $this->borne;
    }

    /**
     * @param mixed $borne
     */
    public function setBorne($borne)
    {
        $this->borne = $borne;
    }


}

