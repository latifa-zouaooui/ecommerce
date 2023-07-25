<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

class AfficheProduitController extends AbstractController
{
    /**
     * @Route("/affiche/produit", name="app_affiche_produit")
     */
    public function index(): Response
    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findBy([/*'id'=>'1'*/]);
        return $this->render('affiche_produit/index.html.twig', ['produits' => $produits,]);
    }
}
