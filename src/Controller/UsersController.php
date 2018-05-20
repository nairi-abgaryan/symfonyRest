<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller
{
    /**
     * @Route("/add/users", name="users")
     */
    public function index()
    {
        return $this->render('front/users.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
}
