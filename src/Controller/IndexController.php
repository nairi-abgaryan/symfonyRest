<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Numbers;
use App\Entity\Users;

/**
 * 
 */
class IndexController extends Controller
{
	/**
	* @Route("/")
	*/
	public function index() {
		return  $this->render("front/index.html.twig");
	}	

	/**
	* @Route("/get/data")
	*/
	public function getData(Request $request) {
   		if ($request->isMethod('get')) {
   			$entity = $this->getDoctrine()->getManager();
   			$users = $entity->getRepository(Users::class)->findAll();
   			$numbers = $entity->getRepository(Numbers::class)->findAll();
			var_dump($users);
			var_dump($numbers);die;
   		}
		return  $this->render("front/index.html.twig");
	}

}