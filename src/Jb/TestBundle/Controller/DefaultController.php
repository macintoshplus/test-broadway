<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jb\TestBundle\Domain\Command\Test1Command;
use Jb\TestBundle\Domain\Command\Test2Command;

class DefaultController extends Controller
{
	/**
	 * Make new aggregate and save it
	 * @param string $name
	 * @return Response
	 */
    public function indexAction($name)
    {
    	//Générate new id
    	$id = $this->get('broadway.uuid.generator')->generate();

    	$this->get('broadway.command_handling.command_bus')->dispatch(new Test1Command($id, $name));

        return $this->render('JbTestBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     *  Change texte in aggragate ID
     * @param uuid string $id
     * @param string $name
	 * @return Response
     */
    public function changeAction($id, $name)
    {

    	$this->get('broadway.command_handling.command_bus')->dispatch(new Test2Command($id,$name));

        return $this->render('JbTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
