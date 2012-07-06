<?php

namespace LPE\YopnoteBundle\Entity;

use LPE\YopnoteBundle\Entity\Note;
/**
 * LPE\YopnoteBundle\Entity\RestNote;
 */
class RestNote
{
    /**
     * @var integer $id
     *
     */
    private $id;

    /**
     * @var string $text
     *
     */
    private $text;

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
    * Contructor
    *
    * @param Note $note
    **/
    public function __construct($note){
    	$this->id = $note->getId();
    	$this->text = $note->getText();
    }

    /**
    * Convert a Note array into a RestNote Array
    *
    * @param Array $array
    **/
    public static function toRestArray($array){
    	if($array == null)
    		return $array;
    	$result = array();

    	foreach($array as $note){
    		$result[] = new RestNote($note);
    	}
    	return $result;
    }
}
