<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    public function maMethode(): Response
    {
        require_once(__DIR__.'/../quizz/index.php');
        return $this->render('action/index.html.twig', [
            'controller_name' => 'ActionController',
        ]);
    }
}
