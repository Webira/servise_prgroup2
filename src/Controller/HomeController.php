<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // on récupere le dernier article inseré en BDD en utilisant 
        //le repository lié à notre entité Article (ArticleRepository) puis on exécute 
        //la function qui nous convient, dans notre cas c'est le findOnBy(), 
        $article = $this->getDoctrine()->getRepository(Article::class)->findOneBy([],
         ["dateDeCreation" => "DESC"]);   // le premier paramétre array [] est vide car 
         //on souhaite récuperer le dernier article sans critére (quelque soit sont titre, contenu....) 
         //et le deuxieme indique par ordre de quoi (dateDeCreation) et le sens ("DESC").

        //dd($article);

        return $this->render('home/accueil.html.twig', [
            "article"=> $article
        ]);
    }
}
