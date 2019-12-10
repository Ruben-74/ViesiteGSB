<?php

namespace App\Controller;

use App\Entity\Visiteur;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="account_index")
     */
    public function index(Visiteur $visiteur)
    {
        return $this->render('user/compte.html.twig', [
            'visiteur' => $visiteur
        ]);
    }
}