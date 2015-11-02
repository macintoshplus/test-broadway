<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Listener;

use Broadway\Processor\Processor;
use Broadway\Domain\DomainMessage;
use Jb\TestBundle\Domain\Event\Test1Event;
use Jb\TestBundle\Domain\Event\Test2Event;
use Doctrine\Common\Persistence\ObjectManager;
use Jb\TestBundle\Entity\Message;

class MyEventListener extends Processor
{
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    protected function handleTest2Event(Test2Event $evt, DomainMessage $message)
    {

        dump($message);
        $obj = $this->em->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$message->getId()));
        if (!$obj) {
            throw new \Exception(sprintf('View for this aggregate id "%s" not exist !', $message->getId()));
        }
        $obj->setTexte($evt->getTexte());
        $obj->setVersion($message->getPlayhead());

        $this->em->persist($obj);
        $this->em->flush();
    }

    protected function handleTest1Event(Test1Event $evt, DomainMessage $message)
    {
        dump($message);
        $obj = new Message();
        $obj->setId($message->getId());
        $obj->setTexte($evt->getTexte());
        $obj->setVersion($message->getPlayhead());

        $this->em->persist($obj);
        $this->em->flush();
    }
}
