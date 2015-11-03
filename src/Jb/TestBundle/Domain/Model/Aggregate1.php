<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Model;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Jb\TestBundle\Domain\Event\CreatedEvent;
use Jb\TestBundle\Domain\Event\TextUpdatedEvent;
use Jb\TestBundle\Domain\Event\LockedEvent;
use Jb\TestBundle\Domain\Event\UnlockedEvent;

/**
 * My exemple
 */
class Aggregate1 extends EventSourcedAggregateRoot
{
    /**
     * @rav string $text
     */
    private $text;

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var State\BaseState
     */
    private $state;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->state = new State\InitialState($this);
    }

    /**
     * command for make aggregate
     * @param  string     $id
     * @param  string     $text
     * @return Aggregate1
     */
    public static function make($id, $text)
    {
        $ag = new Aggregate1();

        $ag->apply(new CreatedEvent($id, $text));

        return $ag;
    }

    /**
     * return ID.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * return ID.
     *
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->getId();
    }

    /**
     * Gets the value of text.
     *
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Check if this aggregate is locked.
     *
     * @return boolean
     */
    public function isLocked()
    {
        return ($this->state instanceof \Jb\TestBundle\Domain\Model\State\LockedState);
    }

    /**
     * @param string $text
     */
    public function updateText($text)
    {
        $this->state->updateText($text);
        $this->applyAllEvents();
    }

    /**
     * Lock this aggregate
     */
    public function lock()
    {
        $this->state->lock();
        $this->applyAllEvents();
    }

    /**
     * Unlock this aggregate
     */
    public function unlock()
    {
        $this->state->unlock();
        $this->applyAllEvents();
    }

    /**
     * Apply event to this aggregate for update
     * @param CreatedEvent $event
     */
    protected function applyCreatedEvent(CreatedEvent $event)
    {
        $this->text = $event->getText();
        $this->id = $event->getId();
    }

    /**
     * Apply event to this aggregate for update
     * @param TextUpdatedEvent $event
     */
    protected function applyTextUpdatedEvent(TextUpdatedEvent $event)
    {
        $this->text = $event->getText();
    }

    /**
     * Apply event to this aggregate for update. Here is the efective state change.
     * @param LockedEvent $event
     */
    protected function applyLockedEvent(LockedEvent $event)
    {
        $this->state = new State\LockedState($this);
    }

    /**
     * Apply event to this aggregate for update. Here is the efective state change.
     * @param UnlockedEvent $event
     */
    protected function applyUnlockedEvent(UnlockedEvent $event)
    {
        $this->state = new State\InitialState($this);
    }

    /**
     * This function get all event created by state object and apply.
     */
    private function applyAllEvents()
    {
        $events = $this->state->getEvents();
        foreach ($events as $event) {
            $this->apply($event);
        }
    }
}
