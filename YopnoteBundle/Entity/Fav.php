<?php

namespace LPE\YopnoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LPE\YopnoteBundle\Entity\Fav
 *
 * @ORM\Table(name="Fav")
 * @ORM\Entity(repositoryClass="LPE\YopnoteBundle\Entity\FavRepository")
 */
class Fav
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $hash
     *
     * @ORM\Column(name="hash", type="string", length=32)
     */
    private $hash;

    /**
     * @ORM\ManyToMany(targetEntity="Folder", inversedBy="favs")
     * @ORM\JoinTable(name="favs_folders")
     */
    protected $folders;

    public function __construct()
    {
        $this->folders = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hash
     *
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }
}
