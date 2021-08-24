<?php

namespace App\Controller;

use App\Form\PromoteType;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    
    /**
     * @Route("/promote_{id<\d+>}", name="promote")
     */
    public function promoteToAdmin($id, Request $request, EntityManagerInterface $manager)
    {
        $secret = "azertyA1"; //code secret de admin
        $form = $this->createForm(PromoteType::class);
        $form->handleRequest($request);

        // on récupere mote pass de bass
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        if(!$user){
            $this->addFlash('erreur', 'l\'utilisateur n\éxiste pas !');
        }
        if($form->isSubmitted() && $form->isValid())
        {

            //on compare la saisie dans le formulaire avec le mot de pass secret stocké dans $secret
            if($form->get("secret")->getData() != $secret )
            {
                throw $this->createNotFoundException("vous n'avez pas le bon code, vous êtes un
                 intrus ! ! !");
            }

            $user->setRoles(["ROLE_ADMIN"]);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');

    }

    return $this->render("security/promote.html.twig", [
        "formPromote" => $form->createView(),
        "user" => $user
    ]);
}
}
