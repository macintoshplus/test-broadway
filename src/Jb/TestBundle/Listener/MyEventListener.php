<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Listener;

use Broadway\Processor\Processor;
use Broadway\Domain\DomainMessage;
use Doctrine\ORM\EntityManager;
use Jb\TestBundle\Entity\Message;

use Jb\TestBundle\Domain\Event\CreatedEvent;
use Jb\TestBundle\Domain\Event\TextUpdatedEvent;
use Jb\TestBundle\Domain\Event\LockedEvent;
use Jb\TestBundle\Domain\Event\UnlockedEvent;

class MyEventListener extends Processor
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    protected function handleCreatedEvent(CreatedEvent $evt, DomainMessage $message)
    {
        $obj = new Message();
        $obj->setId($evt->getId())
            ->setTexte($evt->getText())
            ->setVersion($message->getPlayhead())
            ->setLocked(false);

        $this->em->persist($obj);
        $this->em->flush();
    }

    protected function handleTextUpdatedEvent(TextUpdatedEvent $evt, DomainMessage $message)
    {
        $obj = $this->em->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$message->getId()));
        if (!$obj) {
            throw new \Exception("View for this aggregate id ".$message->getId()." not exist !");

        }
        $obj->setTexte($evt->getText());
        $obj->setVersion($message->getPlayhead());

        $this->em->persist($obj);
        $this->em->flush();
    }

    protected function handleLockedEvent(LockedEvent $evt, DomainMessage $message)
    {
        $obj = $this->em->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$message->getId()));
        if (!$obj) {
            throw new \Exception("View for this aggregate id ".$message->getId()." not exist !");

        }
        $obj->setLocked(true);
        $obj->setVersion($message->getPlayhead());

        $this->em->persist($obj);
        $this->em->flush();
    }

    protected function handleUnlockedEvent(UnlockedEvent $evt, DomainMessage $message)
    {
        $obj = $this->em->getRepository('JbTestBundle:Message')->findOneBy(array('id'=>$message->getId()));
        if (!$obj) {
            throw new \Exception("View for this aggregate id ".$message->getId()." not exist !");

        }
        $obj->setLocked(false);
        $obj->setVersion($message->getPlayhead());

        $this->em->persist($obj);
        $this->em->flush();
    }
}
