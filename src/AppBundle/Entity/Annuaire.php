<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Annuaire
 *
 * @ORM\Table(name="Annuaire", indexes={@ORM\Index(name="IDX_BC1DC55D9FF5F4D4", columns={"Annuaire_Catégorie_ID"}), @ORM\Index(name="IDX_BC1DC55DDC04D878", columns={"Annuaire_Borne_ID"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnuaireRepository")
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
     * @var string
     *
     * @ORM\Column(name="Annuaire_Adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

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
     * @var \AppBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Annuaire_Status", referencedColumnName="Status_Id")
     * })
     */
    private $status;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\AnnuaireBorne", mappedBy="annuaire", cascade={"persist"})
    */
    private $annuaireBorne;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\ImagesAnnuaire", mappedBy="annuaire", cascade={"persist"})
    */
    private $annuaireImage;
    
    public function __construct()
    {
        $this->annuaireBorne = new ArrayCollection();
        $this->annuaireImage = new ArrayCollection();
    }

    public function __toString() {
        return $this->nom;
    }
    
    public function addAnnuaireBorne(AnnuaireBorne $annuaireBorne)
    {
        $this->annuaireBorne[] = $annuaireBorne;
        $annuaireBorne->setAnnuaire($this);

        return $this;
    }
    
    public function removeAnnuaireBorne(AnnuaireBorne $annuaireBorne)
    {
        $this->annuaireBorne->removeElement($annuaireBorne);
    }
    
    public function getAnnuaireBorne()
    {
        return $this->annuaireBorne;
    }

    public function addAnnuaireImage(ImagesAnnuaire $annuaireImage)
    {
        $this->annuaireImage[] = $annuaireImage;
        $annuaireImage->setAnnuaire($this);

        return $this;
    }

    public function removeAnnuaireImage(ImagesAnnuaire $annuaireImage)
    {
        $this->annuaireImage->removeElement($annuaireImage);
    }

    public function getAnnuaireImage()
    {
        return $this->annuaireImage;
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
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}

