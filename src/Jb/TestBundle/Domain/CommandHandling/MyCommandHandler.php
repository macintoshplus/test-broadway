<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\CommandHandling;

use Jb\TestBundle\Domain\Command;
use Broadway\EventSourcing\EventSourcingRepository;
use Jb\TestBundle\Domain\Model\Aggregate1;
use Broadway\CommandHandling\CommandHandler;

/**
* The command handler execute the command.
* The setting in service is defined in src/Jb/TestBundle/Resources/config/services.yml
* The name of function is the command name with "handle" prefix.
*/

class MyCommandHandler extends CommandHandler
{
    
    private $repository;

    public function __construct(EventSourcingRepository $repository){
    	$this->repository = $repository;

    }
    public function handleTest1Command(Command\Test1Command $command)
    {
        //echo "CommandHandling : " . $command->getTexte() . "\n";
        $obj = Aggregate1::make($command->getId(), $command->getTexte());
        
        $this->repository->add($obj);
    }

    public function handleTest2Command(Command\Test2Command $command)
    {
        //echo "CommandHandling : " . $command->getTexte() . " for aggregate id ".$command->getId()."\n";
        $obj = $this->repository->load($command->getId());
        $obj->test2($command);
        $this->repository->add($obj);
    }
}