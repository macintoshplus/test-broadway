<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Model;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Jb\TestBundle\Domain\Command\Test1Command;
use Jb\TestBundle\Domain\Event\Test1Event;
use Jb\TestBundle\Domain\Command\Test2Command;
use Jb\TestBundle\Domain\Event\Test2Event;
use Jb\TestBundle\Domain\Exceptions;

/**
 * My exemple
 */
class Aggregate1 extends EventSourcedAggregateRoot
{
    /**
     * @rav string $texte
     */
    private $texte;
    /**
     * @var string $id
     */
    private $id;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * command for make aggregate
     * @param string $id
     * @param string $texte
     * @return Aggregate1
     */
    public static function make($id, $texte)
    {
        $ag = new Aggregate1();

        $ag->apply(new Test1Event($id, $texte));

        return $ag;
    }

    /**
     * return ID
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Test2Command
     */
    public function test2(Test2Command $command)
    {
        $this->apply(new Test2Event($this->id, $command->getTexte()));
    }

    protected function applyTest1Event(Test1Event $event)
    {
        $this->texte = $event->texte;
        $this->id = $event->id;
    }
    protected function applyTest2Event(Test2Event $event)
    {
        $this->texte = $event->texte;
    }

    /**
     * return ID
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->getId();
    }
}
