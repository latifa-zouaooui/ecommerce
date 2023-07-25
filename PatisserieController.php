<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patisserie;
use App\Form\PatisserieType;
use Symfony\Component\HttpFoundation\Request;

class PatisserieController extends AbstractController
{
    /**
     * @Route("/patisserie", name="app_patisserie")
     */
    public function index(Request $request)
    {
        {
        $patisserie = new Patisserie();
        $form = $this->createForm(PatisserieType::class, $patisserie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $patisserie = $form->getData();
        //****************Manage Uploaded FileName
        $photo_prod = $form->get('image')->getData();
        $originalFilename = $photo_prod->getClientOriginalName();
        $newFilename = $originalFilename.'-'.uniqid().'.'.$photo_prod->getClientOriginalExtension();
        $photo_prod->move($this->getParameter('images_directory'),$newFilename);
        $patisserie->setImage($newFilename);
        //****************
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($patisserie);
        $entityManager->flush();
        //return $this->redirectToRoute('confirm');
        }
        return $this->render('patisserie/index.html.twig', ['form' => $form->createView(),]);
        }
        }
        }

