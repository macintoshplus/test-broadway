<?php

namespace Jb\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JbTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
