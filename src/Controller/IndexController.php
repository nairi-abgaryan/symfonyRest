<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * 
 */
class IndexController extends Controller
{
	/**
	* @Route("/")
	*/
	public function index() {
		return  $this->render("front/index.html.twig", [
			'controller_name' => 'IndexController',
		]);
	}	

}