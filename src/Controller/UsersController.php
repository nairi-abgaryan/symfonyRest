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
     * @Method({"GET", "POST"})
     */
   	public function createRecord(Request $request) {
   		if ($request->isMethod('post') && $request->isXmlHttpRequest()) {
   			$entity = $this->getDoctrine()->getManager();
   			$user = new Users();
   			$user->setFname($request->request->get('fname'));
   			$user->setLname($request->request->get('lname'));
   			$user->setEmail($request->request->get('email'));
   			$entity->persist($user);
   			$entity->flush();
            echo json_encode(['success' => 'User created successfully']);
        }
   		return $this->render('front/users.html.twig');
   	}

   	/**
     * Matches("/edit/user/*")
	 * @Route("/edit/user/{id}", name="editUsers")
     * @Method({"GET", "PUT"})
     */
   	public function updateRecord(Request $request) {
        $id = explode("/", $_SERVER['REQUEST_URI'])[3];
        $data = $this->getDoctrine()
                     ->getRepository(Users::class)
                     ->find($id);
        if ($request->isXmlHttpRequest() && $request->isMethod('put')) {
            $entity = $this->getDoctrine()->getManager();
            $data->setFname($request->request->get('fname'));
            $data->setLname($request->request->get('lname'));
            $data->setEmail($request->request->get('email'));
            $entity->persist($data);
            $entity->flush();
            return new Response("success");
        }
        return $this->render('front/edit-user.html.twig', ['data' => $data]);
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
            $entity = $this->getDoctrine()->getManager();
            $entity->remove($data);
            $entity->flush();
            return $this->render('front/users-table.html.twig');
        }
        return $this->render('front/users-table.html.twig');
   	}

    /**
    * @Route("/get/users")
    * @Method({"GET"})
    */
    public function getAll(Request $request) {
        if($request->isXmlHttpRequest()) {
          $entity = $this->getDoctrine()->getManager();
          $users = $entity->getRepository(Users::class)->findAll();
          $normalizer = new ObjectNormalizer();
          $normalizer->setIgnoredAttributes(array($users));
          $encoder = new JsonEncoder();
          $serializer = new Serializer(array($normalizer), array($encoder));
          $data = $serializer->serialize($users, 'json');
          return new JsonResponse($data);
        }
        return $this->render('front/users-table.html.twig');
    }

}
