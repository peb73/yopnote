<?php

namespace LPE\YopnoteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FolderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FolderRepository extends EntityRepository
{
    /**
    * Find a folder whith his hash.
    **/
    public function findByHash($hash)
    {
        $result = $this->getEntityManager()
            ->createQuery('SELECT l FROM LPEYopnoteBundle:Folder l WHERE l.hash = :hash')
	    ->setParameter('hash',$hash)
            ->getResult();
	if(sizeof($result)==0)
	    return null;
	return $result[0];
    }

    /**
    * Return all Folder
    **/
    public function findAll()
    {
        $result = $this->getEntityManager()
            ->createQuery('SELECT l FROM LPEYopnoteBundle:Folder l')
            ->getResult();
	if(sizeof($result)==0)
	    return array();
	return $result;
    }

}