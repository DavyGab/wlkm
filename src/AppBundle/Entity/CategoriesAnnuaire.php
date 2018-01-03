<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesAnnuaire
 *
 * @ORM\Table(name="Catégories_Annuaire")
 * @ORM\Entity
 */
class CategoriesAnnuaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Catégories_Annuaire_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Catégories_Annuaire_Nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Catégories_Annuaire_Image", type="string", length=0, nullable=true)
     */
    private $image;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return int
     */
    public function getiD()
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    
}

