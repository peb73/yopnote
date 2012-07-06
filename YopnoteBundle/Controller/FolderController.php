<?php

namespace LPE\YopnoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \FOS\RestBundle\View\View as ControlerView;

use LPE\YopnoteBundle\Entity\RestFolder;
use LPE\YopnoteBundle\Entity\Folder;

class FolderController extends Controller
{
	public function getFoldersAction(){
		$request = $this->getRequest();
		$all = $request->query->has('all');
			
		$repository = $this->getDoctrine()
			           ->getRepository('LPEYopnoteBundle:Folder');
		$folder = $repository->findAll();
		
		return RestFolder::toRestArray($folder,$all);
	}

	public function getFolderAction($hash){

		//TODO remove it :)
		if($hash == 666)	
			return $this->getHash();

		$request = $this->getRequest();

		$all = $request->query->has('all');
		
		$repository = $this->getDoctrine()
			           ->getRepository('LPEYopnoteBundle:Folder');
		$folder = $repository->findByHash($hash);
		if($folder==null){		
			$view = ControlerView::create()
				->setStatusCode(404)
				->setData("Folder doesn't exist");
			return $this->get('fos_rest.view_handler')->handle($view);
		}else{
			return new RestFolder($folder,$all);
		}
	}

	public function putFolderAction($id){
		$view = ControlerView::create()
			->setStatusCode(404);
		return $this->get('fos_rest.view_handler')->handle($view);
	}

	public function postFolderAction(){
		try{
			$request = $this->getRequest();
	
			if($request->get('name')!=null && $request->get('name')!=""){
				$name = $request->get('name');
			}else{
				throw new \Exception('412 name null');
			}
			$request->get('private')!=null && ($request->get('private')==true || $request->get('private')=="true")?$private = true : $private = false;

	 		$folder = new Folder();
			$hash = $this->getHash();	


			$em = $this->getDoctrine()->getEntityManager();
			//TODO Transactions

			$repository = $em->getRepository('LPEYopnoteBundle:Folder');

			$i = 0;
			while($repository->findByHash($hash)!=null){
				$i++;
				$hash = $this->getHash($i);
			}

			$folder->setHash($hash);
			$folder->setName($name);
			$folder->setPrivate($private);

			$em->persist($folder);
			$em->flush();
				
			$view = ControlerView::create()
				->setStatusCode(201)
				->setData(new RestFolder($folder));

			return $this->get('fos_rest.view_handler')->handle($view);
		}catch(\Exception $e){
			switch ($e->getMessage()) {
				case "412 name null":
			        	$view = ControlerView::create()
						->setStatusCode(412)
						->setData("Name could not be null");
					return $this->get('fos_rest.view_handler')->handle($view);
				default:
					throw $e;
			}	
		}
	}
	
	private function getHash($correcteur = 0){
		$salt = 134000000000;
		$tmp = floor(microtime(true)*100)-$salt+$correcteur;
		$hash = $this->getChar(floor($tmp));

		return $hash;
	}

	private function getChar($value){
		$charList = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$strlen = strlen($charList);
		if($value<$strlen)
			return $charList[$value];
		else
			return $this->getChar(floor($value/$strlen)).$this->getChar(fmod($value,$strlen));	
	}
}
