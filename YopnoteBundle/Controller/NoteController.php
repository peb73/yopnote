<?php

namespace LPE\YopnoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \FOS\RestBundle\View\View as ControlerView;

use LPE\YopnoteBundle\Entity\RestNote;
use LPE\YopnoteBundle\Entity\Note;

class NoteController extends Controller
{
	public function getNotesAction($slug){

		$repository = $this->getDoctrine()
			           ->getRepository('LPEYopnoteBundle:Folder');
		$folder = $repository->findByHash($slug);
		
		if($folder==null){
			$view = ControlerView::create()
				->setStatusCode(404)
				->setData("Folder doesn't exist");
			return $this->get('fos_rest.view_handler')->handle($view);
		}
		$notes = $folder->getNotes();

		return RestNote::toRestArray($notes);
	}

	public function postNoteAction($folderHash){
		
		$request = $this->getRequest();
		$text = $request->get('text');

		if($text == ""){
			$view = ControlerView::create()
				->setStatusCode(412)
				->setData("Text could not be null");
			return $this->get('fos_rest.view_handler')->handle($view);
		}

		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('LPEYopnoteBundle:Folder');

		$folder = $repository->findByHash($folderHash);
		if($folder==null){
			$view = ControlerView::create()
				->setStatusCode(404)
				->setData("Folder doesn't exist");
			return $this->get('fos_rest.view_handler')->handle($view);
		}

		$note = new Note();
		$note->setText($text);

		$folder->addNote($note);	

		$em->persist($note);
		$em->flush();


		$view = ControlerView::create()
			->setStatusCode(201)
			->setData(new RestNote($note));
		return $this->get('fos_rest.view_handler')->handle($view);
	}
}
