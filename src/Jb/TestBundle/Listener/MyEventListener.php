<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Listener;

use Broadway\Processor\Processor;
use Broadway\Domain\DomainMessageInterface;
use Jb\TestBundle\Domain\Event\Test1Event;
use Jb\TestBundle\Domain\Event\Test2Event;
use Doctrine\ORM\EntityManager;
use Jb\TestBundle\Entity\Message;

class MyEventListener extends Processor {

	private $em;

	public function __construct(EntityManager $em){
		$this->em = $em;
	}

    protected function handleTest2Event(Test2Event $evt, DomainMessageInterface $message){
		$obj = $this->em->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$evt->id));
		if(!$obj){
			throw new \Exception("View for this aggregate id ".$evt->id." not exist !");
			
		}
		$obj->setTexte($evt->texte);
		$obj->setVersion($message->getPlayhead());

        

        $this->em->persist($obj);
        $this->em->flush();
    }

    protected function handleTest1Event(Test1Event $evt, DomainMessageInterface $message){
    	$obj = new Message();
    	$obj->setId($evt->id);
    	$obj->setTexte($evt->texte);
		$obj->setVersion($message->getPlayhead());

        

        $this->em->persist($obj);
        $this->em->flush();
    }
}


