<?php

namespace FarmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{

    public function showAction()
    {
        return $this->render('FarmBundle:Cart:cart.html.twig');
    }

    public function addAction()
    {

    }

}
