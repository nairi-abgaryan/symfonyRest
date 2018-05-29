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
use App\Entity\Numbers;

class NumbersController extends Controller
{
    /**
     * @Route("/add/numbers", name="addNumbers")
     */
    public function createRecord(Request $request)
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

    /**
     * Matches("/edit/number/*")
     * @Route("/edit/number/{id}", name="editNumbers")
     * @Method({"GET", "PUT"})
     */
    public function updateRecord(Request $request, $id) {
        $data = $this->getDoctrine()
                     ->getRepository(Numbers::class)
                     ->find($id);
        if ($request->isXmlHttpRequest() && $request->isMethod('put')) {
            $entity = $this->getDoctrine()->getManager();
            $data->setUserId($request->request->get('user_id'));
            $data->setHome($request->request->get('home'));
            $data->setOffice($request->request->get('office'));
            $data->setMobile($request->request->get('mobile'));
            $entity->persist($data);
            $entity->flush();
            return new Response("success");
        } 
        return $this->render('front/edit-number.html.twig', ['data' => $data]);
    }

    /**
     * Matches("/delete/number/*")
     * @Route("/delete/number/{id}", name="deleteNumbers")
     * @Method({"GET", "DELETE"})
     */
    public function deleteRecord(Request $request, $id) {
       if ($request->isXmlHttpRequest() && $request->isMethod('delete')) {
            $data = $this->getDoctrine()
                     ->getRepository(Numbers::class)
                     ->find($id);
            $entity = $this->getDoctrine()->getManager();
            $entity->remove($data);
            $entity->flush();
        }
        return $this->render('front/numbers-table.html.twig');
    }

    /**
    * @route("/get/numbers")
    * @Method({"GET"})
    */
    public function getAll(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $entity = $this->getDoctrine()->getManager();
            $numbers = $entity->getRepository(Numbers::class)->findAll();
            $normalizer = new ObjectNormalizer();
            $normalizer->setIgnoredAttributes(array($numbers));
            $encoder = new JsonEncoder();
            $serializer = new Serializer(array($normalizer), array($encoder));
            $data = $serializer->serialize($numbers, 'json');
            return new JsonResponse($data);
        }
        return $this->render('front/numbers-table.html.twig');
    }

}
