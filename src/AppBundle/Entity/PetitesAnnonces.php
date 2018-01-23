<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PetitesAnnonces
 *
 * @ORM\Table(name="Petites_Annonces", indexes={@ORM\Index(name="IDX_CE68952CFBB88C40", columns={"Petites_Annonces_Catégorie_ID"}), @ORM\Index(name="IDX_CE68952C9640AF6E", columns={"Petites_Annonces_Borne_ID"})})
 * @ORM\Entity
 */
class PetitesAnnonces
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Petites_Annonces_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Petites_Annonces_Titre", type="string", length=100, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Petites_Annonces_Annonce", type="string", length=0, nullable=true)
     */
    private $annonce;

    /**
     * @var string
     *
     * @ORM\Column(name="Petites_Annonces_Téléphone", type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Petites_Annonces_Date_Heure", type="datetime", nullable=true)
     */
    private $dateHeure;

    /**
     * @var float
     *
     * @ORM\Column(name="Petites_Annonces_Prix", type="float", precision=53, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="Petites_Annonces_Nombre_Vues", type="integer", nullable=true)
     */
    private $nombreVues;

    /**
     * @var \AppBundle\Entity\CategoriesAnnonce
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategoriesAnnonce")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Petites_Annonces_Catégorie_ID", referencedColumnName="Catégories_Annonce_ID")
     * })
     */
    private $categorie;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Petites_Annonces_Borne_ID", referencedColumnName="Borne_ID")
     * })
     */
    private $borne;

    function _construct() {
        $this->dateHeure = date('c');
    }

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
     * @return string
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * @param string $annonce
     */
    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
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
     */
    public function setDateHeure($dateHeure)
    {
        $this->dateHeure = $dateHeure;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
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
     * @return CategoriesAnnonce
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param CategoriesAnnonce $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return Bornes
     */
    public function getBorne()
    {
        return $this->borne;
    }

    /**
     * @param Bornes $borne
     */
    public function setBorne($borne)
    {
        $this->borne = $borne;
    }


}

