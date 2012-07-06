<?php

namespace LPE\YopnoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \FOS\RestBundle\View\View as ControlerView;

class FavController extends Controller
{
	public function getFavAction($hash){
		$repository = $this->getDoctrine()
			           ->getRepository('LPEYopnoteBundle:Fav');
		$folder = $repository->findByHash($hash);
		if($folder==null){		
			$view = ControlerView::create()
				->setStatusCode(404);
			return $this->get('fos_rest.view_handler')->handle($view);
		}else{
			return $folder;
		}
	}

	public function postFavAction(){
		$view = ControlerView::create()
			->setStatusCode(404);
		return $this->get('fos_rest.view_handler')->handle($view);
	}
}
