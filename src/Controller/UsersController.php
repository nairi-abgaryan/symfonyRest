<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Entity\Users;
use App\Entity\Numbers;

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
     * Matches("/edit/user/*")
     * @Route("/edit/user/{id}", name="editUsers")
     */
    public function updateRecordView(Request $request) {
        
    }

   	/**
     * Matches("/edit/user/*")
	 * @Route("/edit/user/{id}", name="editUsers")
     * @Method({"GET", "PUT"})
     */
   	public function updateRecord(Request $request) {
        if ($request->isXmlHttpRequest() && $request->isMethod('put')) {
        } 
        $id = explode("/", $_SERVER['REQUEST_URI'])[3];
        $data = $this->getDoctrine()
        ->getRepository(Users::class)
        ->find($id);
        return $this->render('front/edit.html.twig', ['data' => $data]);
   	}

   	/**
     * Matches("/delete/user/*")
	 * @Route("/delete/user/{id}", name="deleteUsers")
     * @Method({"GET", "DELETE"})
     */
   	public function deleteRecord(Request $request) {
   		if ($request->isXmlHttpRequest() && $request->isMethod('delete')) {
            $id = explode("/", $_SERVER['REQUEST_URI'])[3];
            $data = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($id);
            print_r($data);die;
            return new Response("asd");  
        }
   	}

    /**
    * @Route("/get/users")
    * @Method({"GET"})
    */
    public function getAll(Request $request) {
        if (!$request->isXmlHttpRequest()) {
            return $this->render('front/users-table.html.twig');
        }
        $entity = $this->getDoctrine()->getManager();
        $users = $entity->getRepository(Users::class)->findAll();
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array($users));
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $data = $serializer->serialize($users, 'json');
        return new JsonResponse($data);
    }

}
