<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypesInfosUtiles
 *
 * @ORM\Table(name="Types_Infos_Utiles")
 * @ORM\Entity
 */
class TypesInfosUtiles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Types_Infos_Utiles_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Types_Infos_Utiles_Titre", type="string", length=50, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Types_Infos_Utiles_Image", type="string", length=0, nullable=true)
     */
    private $image;

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

