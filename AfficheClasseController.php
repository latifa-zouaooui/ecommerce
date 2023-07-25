<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classe;
class AfficheClasseController extends AbstractController
{
    /**
     * @Route("/affiche/classe", name="app_affiche_classe")
     */
    public function index(): Response
    {

    $classes = $this->getDoctrine()->getRepository(Classe::class)->findBy([/*'id'=>'1'*/]);
        return $this->render('affiche_classe/index.html.twig', ['classes' => $classes,]);
       
    }
}
