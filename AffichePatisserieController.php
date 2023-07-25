<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patisserie;
use App\Entity\Produit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ProduitRepository;
use App\Repository\PatisserieRepository;




class AffichePatisserieController extends AbstractController
{
    private $ProduitsRepository;

    public function __construct(ProduitRepository $produitRepository,PatisserieRepository $patisserieRepository) 
    {
        $this->ProduitRepository = $produitRepository;
        $this->PatisserieRepository = $patisserieRepository;
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/affiche/patisserie", name="app_affiche_patisserie")
     */
    public function index(): Response
    {
        $patisseries = $this->getDoctrine()->getRepository(Patisserie::class)->findBy([/*'id'=>'1'*/]);
        return $this->render('affiche_patisserie/index.html.twig',['patisseries' => $patisseries,]);
    }
     /**
     * @Route("/affiche/{patisserie}", name="app_affiche_patisserie")
     */
    public function cake(Patisserie $patisserie): Response
    {
        $patisseries= $this->PatisserieRepository->findAll();
        $produits=$this->getDoctrine()->getRepository(Produit::class)->findBy([/*'id'=>'1'*/]);
        return $this->render('affiche_produit/index.html.twig', [
            'produits'=>$patisserie->getProduits(),
            'patisseries' => $patisseries,
        ]);
    }

}
