<?php

namespace My\FrontendBundle\Controller;


use My\DataSourceBundle\Utilities\ProfileHelper;
use My\DataSourceBundle\Entity\Resume;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class LayoutController extends BaseController
{
    public function renderFormSearchAction()
    {
        return $this->render('MyFrontendBundle:_Partial:_formsearch.html.twig');
    }

    public function renderRecommendUserAction()
    {
        return $this->render('MyFrontendBundle:_Partial:_recommenduser.html.twig');
    }

    public function renderTopFriendsActivitiesAction()
    {
        return $this->render('MyFrontendBundle:_Partial:_topfriendsactivities.html.twig');
    }

    public function renderRecommendUpdateAction()
    {
        return $this->render('MyFrontendBundle:_Partial:_recommendupdate.html.twig');
    }
}
