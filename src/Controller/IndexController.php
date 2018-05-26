<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
// use Doctrine\ORM\Query\ResultSetMapping;
// use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\Query\Expr\Join;
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
	* @Method({"GET"})
	*/
	public function getData(Request $request) {
   		if ($request->isXmlHttpRequest()) {
          	$entity = $this->getDoctrine()->getManager();
          	$qb = $entity->createQueryBuilder();
		   	$sql = $qb
		        ->select('u, n')
		        ->from(Users::class, 'u')
		        ->Join(Numbers::class, 'n', Join::WITH, 'u.id = n.user_id')
		    	->getQuery()
		    	->execute();
			$normalizer = new ObjectNormalizer();
			$normalizer->setIgnoredAttributes(array($sql));
			$encoder = new JsonEncoder();
			$serializer = new Serializer(array($normalizer), array($encoder));
			$data = $serializer->serialize($sql, 'json');
			echo $data;
		    return new Response("");
   		}
		return  $this->render("front/index.html.twig");
	}

}