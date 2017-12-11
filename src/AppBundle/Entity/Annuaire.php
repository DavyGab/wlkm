<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annuaire
 *
 * @ORM\Table(name="Annuaire", indexes={@ORM\Index(name="IDX_BC1DC55D9FF5F4D4", columns={"Annuaire_Catégorie_ID"}), @ORM\Index(name="IDX_BC1DC55DDC04D878", columns={"Annuaire_Borne_ID"})})
 * @ORM\Entity
 */
class Annuaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Annuaire_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Annuaire_Nom", type="string", length=200, nullable=true)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="Annuaire_Distance", type="float", precision=53, scale=0, nullable=true)
     */
    private $distance;

    /**
     * @var string
     *
     * @ORM\Column(name="Annuaire_Adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Annuaire_Is_In_Front", type="boolean", nullable=true)
     */
    private $inFront;

    /**
     * @var integer
     *
     * @ORM\Column(name="Annuaire_Nombre_Vues", type="integer", nullable=true)
     */
    private $nombreVues;

    /**
     * @var string
     *
     * @ORM\Column(name="Annuaire_Horaires", type="string", length=0, nullable=true)
     */
    private $horaires;

    /**
     * @var string
     *
     * @ORM\Column(name="Annuaire_Description", type="string", length=0, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Annuaire_Ville", type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Annuaire_Code_Postal", type="string", length=6, nullable=true)
     */
    private $codePostal;

    /**
     * @var \AppBundle\Entity\CategoriesAnnuaire
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategoriesAnnuaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Annuaire_Catégorie_ID", referencedColumnName="Catégories_Annuaire_ID")
     * })
     */
    private $categorie;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Annuaire_Borne_ID", referencedColumnName="Borne_ID")
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
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
     * @return int
     */
    public function getNombreVues()
    {
        return $this->nombreVues;
    }

    /**
     * @param int $nombreVues
     */
    public function setNombreVues($nombreVues)
    {
        $this->nombreVues = $nombreVues;
    }

    /**
     * @return string
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * @param string $horaires
     */
    public function setHoraires($horaires)
    {
        $this->horaires = $horaires;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param string $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return CategoriesAnnuaire
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param CategoriesAnnuaire $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
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

    
}

