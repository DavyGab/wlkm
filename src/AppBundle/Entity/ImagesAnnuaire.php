<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImagesAnnuaire
 *
 * @ORM\Table(name="Images_Annuaire", indexes={@ORM\Index(name="IDX_97FB86A95B40DB09", columns={"Images_Annuaire_ID_Borne"}), @ORM\Index(name="IDX_97FB86A947E93EFD", columns={"Images_Annuaire_ID_Annuaire"})})
 * @ORM\Entity
 */
class ImagesAnnuaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Images_Annuaire_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Images_Annuaire_Url", type="string", length=0, nullable=true)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Images_Annuaire_Is_In_Front", type="boolean", nullable=true)
     */
    private $inFront;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Images_Annuaire_ID_Borne", referencedColumnName="Borne_ID")
     * })
     */
    private $borne;

    /**
     * @var \AppBundle\Entity\Annuaire
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Annuaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Images_Annuaire_ID_Annuaire", referencedColumnName="Annuaire_ID")
     * })
     */
    private $annuaire;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return boolean
     */
    public function isInFront()
    {
        return $this->inFront;
    }

    /**
     * @param boolean $inFront
     */
    public function setInFront($inFront)
    {
        $this->inFront = $inFront;
    }

    /**
     * @return ParcBornes
     */
    public function getBorne()
    {
        return $this->borne;
    }

    /**
     * @param ParcBornes $borne
     */
    public function setBorne($borne)
    {
        $this->borne = $borne;
    }

    /**
     * @return Annuaire
     */
    public function getAnnuaire()
    {
        return $this->annuaire;
    }

    /**
     * @param Annuaire $annuaire
     */
    public function setAnnuaire($annuaire)
    {
        $this->annuaire = $annuaire;
    }


}

