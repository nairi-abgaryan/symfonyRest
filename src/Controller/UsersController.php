<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Users;

class UsersController extends Controller
{
    /**
	 * @Route("/add/users", name="addUsers")
     */
   	public function createRecord(Request $request) {
   		if ($request->isMethod('post') && !empty($request->request->get('fname')) && !empty($request->request->get('lname')) && !empty($request->request->get('email'))) {
   			$entity = $this->getDoctrine()->getManager();
   			$user = new Users();
   			$user->setFname($request->request->get('fname'));
   			$user->setLname($request->request->get('lname'));
   			$user->setEmail($request->request->get('email'));
   			$entity->persist($user);
   			$entity->flush();
   			return $this->redirectToRoute('addUsers');
   		}
   		return $this->render('front/users.html.twig');
   	}

   	/**
	 * @Route("/edit/user/{id}", name="editUsers")
     */
   	public function updateRecord(Request $request) {
   		if ($request->isMethod('put')) {
   			echo "string";
   		}
   		if ($request->request->get('_method') == 'put') {
   			echo "asd";
   		}
   	}

   	/**
	 * @Route("/delete/user/{id}", name="deleteUsers")
     */
   	public function deleteRecord(Request $request) {
   		if ($request->isMethod('delete')) {
   			echo "string";
   		}
   		if ($request->request->get('_method') == 'delete') {
   			echo "asd";
   		}
   	}


}
