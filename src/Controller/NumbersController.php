<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Numbers;

class NumbersController extends Controller
{
    /**
     * @Route("/add/numbers", name="addNumbers")
     */
    public function index(Request $request)
    {
    	if ($request->isMethod('post') && !empty($request->request->get('user_id')) && !empty($request->request->get('mobile')) && !empty($request->request->get('home')) && !empty($request->request->get('office'))) {
   			$entity = $this->getDoctrine()->getManager();
    		$number = new Numbers();
    		$number->setUserId($request->request->get('user_id'));
    		$number->setHome($request->request->get('home'));
    		$number->setOffice($request->request->get('office'));
    		$number->setMobile($request->request->get('mobile'));
    		$entity->persist($number);
   			$entity->flush();
   			return $this->redirectToRoute('addNumbers');
    	}
        return $this->render('front/numbers.html.twig');
    }
}
