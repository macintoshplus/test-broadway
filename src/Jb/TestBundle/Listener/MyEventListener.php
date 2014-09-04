<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Listener;

use Broadway\EventHandling\EventListenerInterface;
use Broadway\Domain\DomainMessageInterface;
use Jb\TestBundle\Domain\Event\Test1Event;
use Jb\TestBundle\Domain\Event\Test2Event;
use Doctrine\ORM\EntityManager;
use Jb\TestBundle\Entity\Message;

class MyEventListener implements EventListenerInterface {

	private $em;

	public function __construct(EntityManager $em){
		$this->em = $em;
	}


	public function handle(DomainMessageInterface $domainMessage)
    {
        
        //print_r($domainMessage);
        $evt = $domainMessage->getPayload();
        $class = explode("\\",get_class($evt));
        $method = 'handle' . end($class);
        if (! method_exists($this, $method)) {

            return;
        }

        $this->$method($evt, $domainMessage->getPlayhead());
    }

    private function handleTest2Event(Test2Event $evt, $version){
		$obj = $this->em->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$evt->id));
		if(!$obj){
			throw new \Exception("View for this aggregate id ".$evt->id." not exist !");
			
		}
		$obj->setTexte($evt->texte);
		$obj->setVersion($version);

        

        $this->em->persist($obj);
        $this->em->flush();
    }

    private function handleTest1Event(Test1Event $evt, $version){
    	$obj = new Message();
    	$obj->setId($evt->id);
    	$obj->setTexte($evt->texte);
		$obj->setVersion($version);

        

        $this->em->persist($obj);
        $this->em->flush();
    }
}


