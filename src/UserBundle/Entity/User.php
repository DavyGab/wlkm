<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="Users")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @var \AppBundle\Entity\Borne
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Borne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_Borne_ID", referencedColumnName="Borne_ID")
     * })
     */
    private $borne;

    /**
     * @return \AppBundle\Entity\Borne
     */
    public function getBorne()
    {
        return $this->borne;
    }

    /**
     * @param \AppBundle\Entity\Borne $borne
     */
    public function setBorne($borne)
    {
        $this->borne = $borne;
    }
}