<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NumbersController extends Controller
{
    /**
     * @Route("/add/numbers", name="numbers")
     */
    public function index()
    {
        return $this->render('front/numbers.html.twig', [
            'controller_name' => 'NumbersController',
        ]);
    }
}
