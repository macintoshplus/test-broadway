<?php

namespace Jb\TestBundle\Domain\CommandHandling;

use Jb\TestBundle\Domain\Command\Test1Command;
use Broadway\EventSourcing\EventSourcingRepository;
use Jb\TestBundle\Domain\Model\Aggregate1;
use Broadway\CommandHandling\CommandHandler;

class MyCommandHandler extends CommandHandler
{
    
    private $repository;

    public function __construct(EventSourcingRepository $repository){
    	$this->repository = $repository;

    }
    public function handleTest1Command(Test1Command $command)
    {
        echo "CommandHandling : " . $command->getTexte() . "\n";
        $obj = new Aggregate1(rand()%100);
        $obj->test1($command);
        $this->repository->add($obj);
    }
}