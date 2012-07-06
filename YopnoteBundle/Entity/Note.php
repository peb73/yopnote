<?php

namespace LPE\YopnoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LPE\YopnoteBundle\Entity\Note
 *
 * @ORM\Table(name="Note")
 * @ORM\Entity(repositoryClass="LPE\YopnoteBundle\Entity\NoteRepository")
 */
class Note
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
     * @var string $text
     *
     * @ORM\Column(name="text", type="string", length=10000)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="notes")
     * @ORM\JoinColumn(name="folder_id", referencedColumnName="id")
     */
    protected $folder;

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
     * Set text
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
    * Set folder
    *
    * @param Folder folder
    */
    public function setFolder($folder){
        $this->folder = $folder;
    }

    /**
    * Get Folder
    *
    * @return Folder
    */
    public function getFolder($folder){
        return $this->folder;
    }

}
