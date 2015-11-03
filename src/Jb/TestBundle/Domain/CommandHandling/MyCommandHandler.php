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

    public function __construct(EventSourcingRepository $repository)
    {
        $this->repository = $repository;

    }
    public function handleCreateCommand(Command\CreateCommand $command)
    {
        $obj = Aggregate1::make($command->getId(), $command->getText());

        $this->repository->save($obj);
    }

    public function handleUpdateTextCommand(Command\UpdateTextCommand $command)
    {
        $obj = $this->repository->load($command->getId());
        $obj->updateText($command->getText());
        $this->repository->save($obj);
    }

    public function handleLockCommand(Command\LockCommand $command)
    {
        $obj = $this->repository->load($command->getId());
        $obj->lock();
        $this->repository->save($obj);
    }

    public function handleUnlockCommand(Command\UnlockCommand $command)
    {
        $obj = $this->repository->load($command->getId());
        $obj->unlock();
        $this->repository->save($obj);
    }
}
