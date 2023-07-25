<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classe;
use App\Form\ClasseType;
use Symfony\Component\HttpFoundation\Request;
class ClasseController extends AbstractController
{
    /**
     * @Route("/classe", name="app_classe")
     */
    public function index(Request $request)

    {
    $classe = new Classe();
    $form = $this->createForm(ClasseType::class, $classe);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $classe = $form->getData();

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($classe);
    $entityManager->flush();
    }
    return $this->render('classe/index.html.twig', ['form' => $form->createView(),]);
    }
}
