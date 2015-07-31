<?php

namespace My\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        //$this->getProfile();die;
        return $this->render('MyUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
