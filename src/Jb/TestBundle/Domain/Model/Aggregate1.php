<?php

namespace Jb\TestBundle\Domain\Model;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Jb\TestBundle\Domain\Command\Test1Command;
use Jb\TestBundle\Domain\Event\Test1Event;

class Aggregate1 extends EventSourcedAggregateRoot
{
	private $texte;

	private $id;

	public function __construct($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function test1(Test1Command $command)
    {
        echo $command->getTexte() . "\n";

        $this->apply(new Test1Event($command->getTexte()));
    }

    protected function applyTest1Event(Test1Event $event)
    {
        $this->texte = $event->texte;
    }

}

