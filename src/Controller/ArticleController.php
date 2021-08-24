<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function allArticles(): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAllOrderByDate();

        //dd($articles);

        return $this->render('article/allArticles.html.twig', [
            "articles" => $articles
        ]);
    }


/**
 * @Route("/article_{id<\d+>}", name="article")
 */

    public function OneArticle($id){

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

    //dd($article);

        return $this->render('article/oneArticle.html.twig', [
        "article" =>$article
        ]);
    }

    /**
     * @Route("/article_ajout", name="article_ajout")
     */
    public function ajoutArticle(Request $request, EntityManagerInterface $manager){

        $article = new Article(); //instaciation d'un objet $article
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $article->setDateDeCreation(new DateTime("now"));

                $manager->persist($article);
                $manager->flush();

            return $this->redirectToRoute('articles');

        }

        return $this->render('article/formulaire.html.twig', [
            "formArticle" => $form->createView()
        ]);
    }

    

    /**
     * @Route("/article_update_{id<\d+>}", name="article_update")
     */
    public function modifArticle($id, Request $request, EntitymanagerInterface $manager)
    {
    
    //on récupere l'article à modifier dont l'id est celui passé dans l'url
    $article =  $this->getDoctrine()->getRepository(Article::class)->find($id);
     //on crée un formulaire de type ArticleType, et on le lie à notre objet $article
    $form = $this->createForm(ArticleType::class, $article);
    // donne accés aux donnée POST
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

            $article->setDateDeModification(new DateTime("now"));
            //le manager set deja déclaré en paramétre de la fonction (injection
              // de dependance)
            //$manager= = $this->getDoctrinae()->getManager(); 

            $manager->persist($article);
            $manager->flush();

        return $this->redirectToRoute('articles');

    }

    return $this->render('article/formulaire.html.twig', [
        "formArticle" => $form->createView(),
        "article"=>$article
    ]);
}

    /**
     * @Route("/article_delete_{id<\d+>}", name="article_delete")
     */
    public function suppArticle($id, EntitymanagerInterface $manager)
    {
    
    //on récupere l'article à supprimer dont l'id est celui passé dans l'url
    $article =  $this->getDoctrine()->getRepository(Article::class)->find($id);
        // le manager crée la requete de suppression de l'article
    $manager->remove($article);

    //puis la suppression s'éxecute
    $manager->flush();

    return $this->redirectToRoute('articles');

    }
    
}