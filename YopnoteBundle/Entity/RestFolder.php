<?php

namespace LPE\YopnoteBundle\Entity;

use LPE\YopnoteBundle\Entity\Folder;
use LPE\YopnoteBundle\Entity\RestNote;

/**
 * LPE\YopnoteBundle\Entity\RestFolder
 */
class RestFolder
{
    private $id;

    private $name;

    private $private;

    private $notes;

    /**
    * Constructor
    *
    * @param Folder $entity
    * @param boolean $all 
    */
    public function __construct($entity,$all = false)
    {
        $this->id = $entity->getHash();
        $this->name = $entity->getName();
        $this->private = $entity->getPrivate();
        if($all)
            $this->notes = RestNote::toRestArray($entity->getNotes());
    }

    /**
    * Convert a Folder array into a Rest array
    *
    * @param array[Folder] $array
    * @param boolean $all
    */
    public static function toRestArray($array,$all = false){
    	if($array==null)
    		return array();
    	$result = array();

    	foreach($array as $entity){
    		$result[] = new RestFolder($entity,$all);
    	}
    	return $result;
    }

    /**
     * Set hash
     *
     * @param string $hash
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
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
     * Set prive
     *
     * @param boolean $private
     */
    public function setPrivate($private)
    {
        $this->private = $private;
    }

    /**
     * Get prive
     *
     * @return boolean 
     */
    public function getPrivate()
    {
        return $this->private;
    }

}
