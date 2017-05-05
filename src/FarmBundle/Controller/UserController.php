<?php

namespace FarmBundle\Controller;

use FarmBundle\Entity\User;
use FarmBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function subscribeAction(Request $request)
    {
        if ($this->getUser() != null){
            return $this->redirectToRoute("home");
        }

        $user = new User();
        $user->setDateCreated(new \DateTime);
        $user->setIsActive(true);

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()){

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Utilisateur enregistrer");

            return $this->redirectToRoute("home");
        }

        return $this->render("FarmBundle:User:subscribe.html.twig", array('userForm' => $userForm->createView()));
    }

    public function loginAction(Request $request)
    {
        if ($this->getUser() != null){
            return $this->redirectToRoute("home");
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('FarmBundle:User:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
