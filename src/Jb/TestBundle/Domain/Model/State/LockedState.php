<?php
/**
 * @author Jean-Baptiste Nahan <jean-baptiste@nahan.fr>
 * @license MIT
 */

namespace Jb\TestBundle\Domain\Model\State;

use Jb\TestBundle\Domain\Event\UnlockedEvent;

class LockedState extends BaseState
{

    public function unlock()
    {
            $this->addEvent(new UnlockedEvent());
    }
}
