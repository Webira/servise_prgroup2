<?php

namespace App\Controller;

use DateTime;
use App\Entity\Blogueur;
use App\Form\BlogueurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogueurController extends AbstractController
{
    /**
     * @Route("/blogueurs", name ="blogueurs")
     */
    public function allBlogueur(): Response
    {
        $blogueurs = $this->getDoctrine()->getRepository(Blogueur::class)->findAll();

        return $this->render('blogueur/allBlogueurs.html.twig', [

            "blogueurs" => $blogueurs
            // 'controller_name' => 'BlogueurController',
        ]);
    }
    
    /**
     * @Route("/blogueur_{id<\d+>}", name ="blogueur")
     */
    public function oneBlogueur($id){
        $blogueur = $this->getDoctrine()->getRepository(Blogueur::class)->find($id);

        return $this->render('blogueur/oneBlogueur.html.twig', [
            "blogueur" => $blogueur
        ]);
    }

    /**
     * @Route("/ajout_blogueur",name="ajout_blogueur")
     */
    public function ajoutBlogueur(Request $request, EntityManagerInterface $manager){

        $blogueur = new Blogueur();
         
        $form = $this->createForm(BlogueurType::class, $blogueur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($blogueur);
                $manager->flush();

            return $this->redirectToRoute('blogueurs');

        }

        return $this->render('blogueur/formulaireBlogueur.html.twig', [
            "formBlogueur" => $form->createView()
        ]);
        
    }

    /**
     * @Route("/blogueur_update_{id<\d+>}", name="blogueur_update")
     */
    public function modifBlogueur($id, Request $request, EntitymanagerInterface $manager)
    {
    
    
        $blogueur =  $this->getDoctrine()->getRepository(Blogueur::class)->find($id);
     
        $form = $this->createForm(BlogueurType::class, $blogueur);
    
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $blogueur->setDateDeModification(new DateTime("now"));
            
            $manager->persist($blogueur);
            $manager->flush();

        return $this->redirectToRoute('blogueurs');

        }

        return $this->render('blogueur/formulaireBlogueur.html.twig', [
        "formBlogueur" => $form->createView()
        ]);
    }

    /**
     * @Route("/blogueur_delete_{id<\d+>}", name="blogueur_delete")
     */
    public function suppBlogueur($id, EntitymanagerInterface $manager)
    {
    
    
        $blogueur =  $this->getDoctrine()->getRepository(Blogueur::class)->find($id);
        
        $manager->remove($blogueur);

    
        $manager->flush();

        return $this->redirectToRoute('blogueurs');

    }
    
    
}