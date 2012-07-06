<?php

namespace LPE\YopnoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * LPE\YopnoteBundle\Entity\Folder
 *
 * @ORM\Table(name="Folder")
 * @ORM\Entity(repositoryClass="LPE\YopnoteBundle\Entity\FolderRepository")
 */
class Folder
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean $private
     *
     * @ORM\Column(name="private", type="boolean")
     */
    private $private;

     /**
     * @ORM\OneToMany(targetEntity="Note", mappedBy="folder")
     */
    protected $notes;

    /**
     * @ORM\ManyToMany(targetEntity="Fav", mappedBy="folders")
     */
    protected $favs;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->favs = new ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set private
     *
     * @param boolean $private
     */
    public function setPrivate($private)
    {
        $this->private = $private;
    }

    /**
     * Get private
     *
     * @return boolean 
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * Get notes
     * @return array
     */
    public function getNotes()
    {
        return $this->notes;
    }

    public function addNote($note)
    {
        $note->setFolder($this);
        $this->notes[] = $note;
    }
}
