<?php

namespace Jb\TestBundle\Tests\Units\Domain\Model\State;

use Jb\TestBundle\Domain\Model\State\InitialState as ObjT;
use \mageekguy\atoum;

class InitialState extends atoum\test
{

    public function testUpdateText()
    {
        $agg = new \mock\Jb\TestBundle\Domain\Model\Aggregate1();
        $agg->getMockController()->getText = 'Test Init';
        $objT = new ObjT($agg);

        $this->assert->variable($objT->updateText('Test 1'))->isNull();

        $events = $objT->getEvents();
        $this->assert->array($events)->hasSize(1);
        $this->object($events[0])->isInstanceOf('Jb\TestBundle\Domain\Event\TextUpdatedEvent');
        $this->string($events[0]->getText())->isEqualTo('Test 1');

    }

    public function testLock()
    {
        $agg = new \mock\Jb\TestBundle\Domain\Model\Aggregate1();
        $objT = new ObjT($agg);

        $this->assert->variable($objT->lock())->isNull();

        $events = $objT->getEvents();
        $this->assert->array($events)->hasSize(1);
        $this->object($events[0])->isInstanceOf('Jb\TestBundle\Domain\Event\LockedEvent');

        $this->mock($agg)->call('getText')->never()
        ->call('getId')->never();
    }

    public function testUnlock()
    {
        $agg = new \mock\Jb\TestBundle\Domain\Model\Aggregate1();
        $objT = new ObjT($agg);

        $this->assert->exception(function () use ($objT) {
            $objT->unlock();
        })->isInstanceOf('Exception');

        $this->mock($agg)->call('getText')->never()
        ->call('getId')->never();

        $this->assert->array($objT->getEvents())->isEmpty();

    }
}
