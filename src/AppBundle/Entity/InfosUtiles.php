<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfosUtiles
 *
 * @ORM\Table(name="Infos_Utiles", indexes={@ORM\Index(name="IDX_FAA829BD304E345E", columns={"Infos_Utiles_Type_ID"}), @ORM\Index(name="IDX_FAA829BD9901E0CB", columns={"Infos_Utiles_Borne_ID"})})
 * @ORM\Entity
 */
class InfosUtiles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Infos_Utiles_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Infos_Utiles_Titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Infos_Utiles_Texte", type="string", length=200, nullable=true)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Infos_Utiles_Date_Heure", type="datetime", nullable=true)
     */
    private $dateHeure;

    /**
     * @var \AppBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Status", referencedColumnName="Status_Id")
     * })
     */
    private $status;

    /**
     * @var \AppBundle\Entity\TypesInfosUtiles
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypesInfosUtiles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Infos_Utiles_Type_ID", referencedColumnName="Types_Infos_Utiles_ID")
     * })
     */
    private $type;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Infos_Utiles_Borne_ID", referencedColumnName="Borne_ID")
     * })
     */
    private $borne;

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
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     * @return InfosUtiles
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateHeure()
    {
        return $this->dateHeure;
    }

    /**
     * @param \DateTime $dateHeure
     * @return InfosUtiles
     */
    public function setDateHeure($dateHeure)
    {
        $this->dateHeure = $dateHeure;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return InfosUtiles
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return TypesInfosUtiles
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param TypesInfosUtiles $type
     * @return InfosUtiles
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
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
     * @return InfosUtiles
     */
    public function setBorne($borne)
    {
        $this->borne = $borne;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }


}

