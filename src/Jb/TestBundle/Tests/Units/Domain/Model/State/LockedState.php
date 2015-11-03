<?php

namespace Jb\TestBundle\Tests\Units\Domain\Model\State;

use Jb\TestBundle\Domain\Model\State\LockedState as ObjT;
use \mageekguy\atoum;

class LockedState extends atoum\test
{

    public function testUnlock()
    {
        $agg = new \mock\Jb\TestBundle\Domain\Model\Aggregate1();
        $objT = new ObjT($agg);

        $this->assert->variable($objT->unlock())->isNull();

        $events = $objT->getEvents();
        $this->assert->array($events)->hasSize(1);
        $this->object($events[0])->isInstanceOf('Jb\TestBundle\Domain\Event\UnlockedEvent');

        $this->mock($agg)->call('getText')->never()
        ->call('getId')->never();
    }

    public function testLock()
    {
        $agg = new \mock\Jb\TestBundle\Domain\Model\Aggregate1();
        $objT = new ObjT($agg);

        $this->assert->exception(function () use ($objT) {
            $objT->lock();
        })->isInstanceOf('Exception');

        $this->mock($agg)->call('getText')->never()
        ->call('getId')->never();

        $this->assert->array($objT->getEvents())->isEmpty();

    }

    public function testUpdateText()
    {
        $agg = new \mock\Jb\TestBundle\Domain\Model\Aggregate1();
        $objT = new ObjT($agg);

        $this->assert->exception(function () use ($objT) {
            $objT->updateText('My content');
        })->isInstanceOf('Exception');

        $this->mock($agg)->call('getText')->never()
        ->call('getId')->never();

        $this->assert->array($objT->getEvents())->isEmpty();

    }
}
