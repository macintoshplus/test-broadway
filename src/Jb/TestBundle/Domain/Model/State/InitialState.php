<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Model\State;

use Jb\TestBundle\Domain\Event\TextUpdatedEvent;
use Jb\TestBundle\Domain\Event\LockedEvent;

class InitialState extends BaseState
{
    public function updateText($text)
    {
        if ($this->aggregate->getText() != $text) {
            $this->addEvent(new TextUpdatedEvent($text));
        }
    }

    public function lock()
    {
            $this->addEvent(new LockedEvent());
    }
}
