<?php

namespace FarmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FarmBundle:Default:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('FarmBundle:Default:about.html.twig');
    }

    public function faqAction()
    {
        return $this->render('FarmBundle:Default:faq.html.twig');
    }

    public function contactAction()
    {
        return $this->render('FarmBundle:Default:contact.html.twig');
    }
}
