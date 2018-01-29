<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * InfosUtiles
 *
 * @ORM\Table(name="Infos_Utiles", indexes={@ORM\Index(name="IDX_FAA829BD304E345E", columns={"Infos_Utiles_Type_ID"}), @ORM\Index(name="IDX_FAA829BD9901E0CB", columns={"Infos_Utiles_Borne_ID"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InfosUtilesRepository")
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
     *   @ORM\JoinColumn(name="Infos_Utiles_Status", referencedColumnName="Status_Id")
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="Infos_Utiles_Created_At", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="Infos_Utiles_Updated_At", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="Infos_Utiles_Date_Début_Validité", type="datetime", length=200, nullable=true)
     */
    private $debut_publication;

    /**
     * @var datetime
     *
     * @ORM\Column(name="Infos_Utiles_Date_Fin_Validité", type="datetime", length=200, nullable=true)
     */
    private $fin_publication;

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

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return datetime
     */
    public function getFinPublication()
    {
        return $this->fin_publication;
    }

    /**
     * @param datetime $fin_publication
     */
    public function setFinPublication($fin_publication)
    {if (is_string($fin_publication)) {
            $fin_publication = DateTime::createFromFormat('d-m-Y', $fin_publication);
        }
        $this->fin_publication = $fin_publication;
    }

    /**
     * @return datetime
     */
    public function getDebutPublication()
    {
        return $this->debut_publication;
    }

    /**
     * @param datetime $debut_publication
     */
    public function setDebutPublication($debut_publication)
    {
        if (is_string($debut_publication)) {
            $debut_publication = DateTime::createFromFormat('d-m-Y', $debut_publication);
        }
        $this->debut_publication = $debut_publication;
    }


}

