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
			var_dump($this->joinAll(new Users()));die;
			var_dump($users);
			var_dump($numbers);die;
   		}
		return  $this->render("front/index.html.twig");
	}

	public function joinAll(Users $u) {
		$query = $this->getEntityManager()->createQueryBuilder()
			        ->add('select', 'c, s, i, m')
			        ->add('from', 'Numbers c')
			        ->leftJoin('c.skills', 's')
			        ->leftJoin('c.interests', 'i')
			        ->leftJoin('c.metAt', 'm')
			        ->where('c.user = :user')
			        ->orderBy('c.lastname', 'ASC')
			        ->setParameters([
			            'user' => $u,
			        ])
			        ->getQuery();

    return $query->getResult();
	}

}