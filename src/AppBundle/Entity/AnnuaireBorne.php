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
     * @var integer
     *
     * @ORM\Column(name="Annuaire_ID", type="integer", nullable=false)
     */
    private $annuaireId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Borne_ID", type="integer", nullable=false)
     */
    private $borneId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Distance", type="integer", nullable=false)
     */
    private $distance;

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
    public function getAnnuaireId()
    {
        return $this->annuaireId;
    }

    /**
     * @param int $annuaireId
     */
    public function setAnnuaireId($annuaireId)
    {
        $this->annuaireId = $annuaireId;
    }

    /**
     * @return int
     */
    public function getBorneId()
    {
        return $this->borneId;
    }

    /**
     * @param int $borneId
     */
    public function setBorneId($borneId)
    {
        $this->borneId = $borneId;
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

    
}

