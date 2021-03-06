<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Borne
 *
 * @ORM\Table(name="Parc_Bornes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BorneRepository")
 */
class Borne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Borne_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="Borne_Login", type="integer", nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="Borne_Nom", type="string", length=25, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Borne_Adresse", type="string", length=50, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Borne_Ville", type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Borne_Code_Postal", type="string", length=6, nullable=true)
     */
    private $codePostal;

    /**
     * @var \AppBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Borne_Status", referencedColumnName="Status_Id")
     * })
     */
    private $status;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\AnnuaireBorne", mappedBy="borne", cascade={"persist"})
    */
    private $annuaireBorne;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="Borne_Created_At", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="Borne_Updated_At", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    public function __construct()
    {
        $this->annuaireBorne = new ArrayCollection();
    }

    public function __toString() {
        return $this->nom;
    }

    public function addAnnuaireBorne(AnnuaireBorne $annuaireBorne)
    {
        $this->annuaireBorne[] = $annuaireBorne;
        $annuaireBorne->setBorne($this);

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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param int $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
}

