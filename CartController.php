<?php

namespace App\Controller;
use App\Repository\ProduitRepository;
use App\Repository\PatisserieRepository;
use App\Entity\Produit;
use App\Entity\Patisserie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_cart")
     */
    public function index(SessionInterface $session,ProduitRepository $produitRepository,PatisserieRepository $patisserieRepository): Response
    {
        $panier = $session->get("panier", []);
    
        $dataPanier = [];
        $prix = 0;
        
        foreach($panier as $id => $quantite){
            
            $produit = $produitRepository->find($id);
            
            $dataPanier[] = [
                "produit" => $produit,
                
                "quantity" => $quantite
            ];
            
            $prix += $produit->getPrice() * $quantite;
        }
    $patisseries = $this->getDoctrine()->getRepository(Patisserie::class)->findBy([/*'id'=>'1'*/]);
    return $this->render('cart/index.html.twig', ['items'=>$dataPanier , 'prixTotal' =>$prix]);
    }
    /**
    * @Route("/add/{id}", name="app_add")
    */
    public function add(SessionInterface $session,$id)
    {
      
    // On récupère le panier actuel
    $panier = $session->get("panier", []);
    
    if(!empty($panier[$id])){
        $panier[$id]++;
    }else{
        $panier[$id] = 1;
    }
    
    // On sauvegarde dans la session
    $session->set("panier", $panier);
    //dd($panier);
    return $this->redirectToRoute('cart');
    }
    
    /**
         * @Route("/remove/{id}", name="remove")
         */
        public function remove(Produit $produit, SessionInterface $session)
        {
            // On récupère le panier actuel
            $panier = $session->get("panier", []);
            $id = $produit->getId();
    
            if(!empty($panier[$id])){
                if($panier[$id] > 1){
                    $panier[$id]--;
                }else{
                    unset($panier[$id]);
                }
            }
    
            // On sauvegarde dans la session
            $session->set("panier", $panier);
    
            return $this->redirectToRoute("cart");
        }
    
        /**
         * @Route("/delete/{id}", name="delete")
         */
        public function delete(Produit $produit, SessionInterface $session)
        {
            // On récupère le panier actuel
            $panier = $session->get("panier", []);
            $id = $produit->getId();
    
            if(!empty($panier[$id])){
                unset($panier[$id]);
            }
    
            // On sauvegarde dans la session
            $session->set("panier", $panier);
    
            return $this->redirectToRoute("cart");
        }
    
        /**
         * @Route("/delete", name="delete_all")
         */
        public function deleteAll(SessionInterface $session)
        {
            $session->remove("panier");
    
            return $this->redirectToRoute("cart");
        }
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
