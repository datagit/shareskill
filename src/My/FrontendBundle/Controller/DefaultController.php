<?php

namespace My\FrontendBundle\Controller;


class DefaultController extends BaseController
{
    public function indexAction()
    {
        $this->getProfile();
        return $this->render('MyFrontendBundle:Default:index.html.twig');
    }
}
