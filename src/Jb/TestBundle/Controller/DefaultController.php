<?php

namespace Jb\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jb\TestBundle\Domain\Command\Test1Command;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

    	$this->get('broadway.command_handling.command_bus')->dispatch(new Test1Command($name));

        return $this->render('JbTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
