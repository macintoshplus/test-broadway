<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Model\State;

use Jb\TestBundle\Domain\Model\Aggregate1;
use Jb\TestBundle\Domain\Event\EventInterface;

abstract class BaseState
{
    protected $aggregate;

    private $events;

    public function __construct(Aggregate1 $aggregate)
    {
        $this->events= [];
        $this->aggregate = $aggregate;
    }

    public function getEvents()
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    public function updateText($text)
    {
        throw new \Exception("Unable to execute this action");
    }

    public function lock()
    {
        throw new \Exception("Unable to execute this action");
    }

    public function unlock()
    {
        throw new \Exception("Unable to execute this action");
    }

    protected function addEvent(EventInterface $event)
    {
        $this->events[] = $event;
    }
}
