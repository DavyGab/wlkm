<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="News", indexes={@ORM\Index(name="IDX_BDE1366ED2DEB4CE", columns={"News_Borne_ID"})})
 * @ORM\Entity
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(name="News_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $newsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="News_Niveau", type="integer", nullable=true)
     */
    private $newsNiveau;

    /**
     * @var integer
     *
     * @ORM\Column(name="News_Nbre", type="integer", nullable=true)
     */
    private $newsNbre;

    /**
     * @var string
     *
     * @ORM\Column(name="News_Titre", type="string", length=50, nullable=true)
     */
    private $newsTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="News_URL", type="string", length=100, nullable=true)
     */
    private $newsUrl;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="News_Borne_ID", referencedColumnName="Borne_ID")
     * })
     */
    private $newsBorne;


}

