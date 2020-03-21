<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Panier;
use App\Form\PanierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}")
 */
class PanierController extends AbstractController
{
    /**
     * @Route("/", name="panier")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paniers = $em->getRepository(Panier::class)->findAll();

        return $this->render('panier/index.html.twig', [
            'paniers' => $paniers,
            'controller_name' => 'PanierController'
        ]);
    }

    /**
     * @Route("/panier/etat/{id}", name="panier_etat")
     */
    public function PanierEtat(Panier $panier=null){
        if($panier != null){
            if($panier->getEtat() == false){
                $panier->setEtat(true);
            }
            else{
                $panier->setEtat(false);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();

            return $this->redirectToRoute('panier', ['id'=>$panier->getId()]);
        }
        else{
            return $this->redirectToRoute('panier');
        }
    }

    /**
     * @Route("/panier/delete/{id}", name="delete_panier")
     */
    public function delete(Panier $panier=null){ // methode pour supprimer un panier 
        if($panier != null){
            $pdo = $this->getDoctrine()->getManager();
            $pdo -> remove($panier); 
            $pdo -> flush();

            $this-> addFlash("success", "Article supprimé du panier.");
        }
        else{
            $this-> addFlash("danger", "Panier introuvable");
        }

        return $this->redirectToRoute('panier');
    }
}