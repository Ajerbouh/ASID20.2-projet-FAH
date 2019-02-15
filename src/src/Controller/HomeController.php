<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/homepage", name="home")
     */
    public function index()
    {
        $conferences =[
            0 => [
                'title' => 'Bonjour',
                'rating' => 1,
                'address' => '1 Avenue Charles de Gaulle 93270 Sevran',
                'users' => 'le chef',
            ],
            1 => [
                'title' => 'Salut',
                'rating' => 3,
                'address' => '26 Rue de la mort 97125 Bouilantes',
                'users' => 'le roi',
            ],
            2 => [
                'title' => 'Hello',
                'rating' => 5,
                'address' => '10 Chemin du Marais du Soucis 93270 Sevran',
                'users' => 'le chef',
            ],
        ];

        return $this->render('home/index.html.twig', [
            'conferences' => $conferences,
        ]);
    }

    /*/**
    * @Route("/registration", name="home")
    */
   /* public function Registration()
    {
        $conferences =[
            0 => [
                'title' => 'Bonjour',
                'rating' => 1,
                'address' => '1 Avenue Charles de Gaulle 93270 Sevran',
                'users' => 'le chef',
            ],
            1 => [
                'title' => 'Salut',
                'rating' => 3,
                'address' => '26 Rue de la mort 97125 Bouilantes',
                'users' => 'le roi',
            ],
            2 => [
                'title' => 'Hello',
                'rating' => 5,
                'address' => '10 Chemin du Marais du Soucis 93270 Sevran',
                'users' => 'le chef',
            ],
        ];

        return $this->render('home/index.html.twig', [
            'conferences' => $conferences,
        ]);
    }*/
}
