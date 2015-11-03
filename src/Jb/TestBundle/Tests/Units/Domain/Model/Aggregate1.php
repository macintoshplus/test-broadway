<?php

namespace Jb\TestBundle\Tests\Units\Domain\Model;

use Jb\TestBundle\Domain\Model\Aggregate1 as ObjT;
use \mageekguy\atoum;

class Aggregate1 extends atoum\test
{
    public function testInit()
    {
        $objT = ObjT::make('Id', 'Init');

        $this->object($objT)->isInstanceOf('Jb\TestBundle\Domain\Model\Aggregate1');

        $this->string($objT->getId())->isEqualTo('Id');
        $this->string($objT->getText())->isEqualTo('Init');
    }

    public function testUpdateTexteOnInitialState()
    {
        $objT = ObjT::make('Id', 'Init');

        $this->assert->variable($objT->updateText('My content'))->isNull();
        $this->string($objT->getText())->isEqualTo('My content');
    }

    public function testUpdateTexteOnLockedState()
    {
        $objT = ObjT::make('Id', 'Init');

        $this->assert->variable($objT->lock())->isNull();
        $this->assert->exception(function () use ($objT) {
            $objT->updateText('My content');
        })->isInstanceOf('Exception');
    }
    public function testUpdateTexteOnUnlockedState()
    {
        $objT = ObjT::make('Id', 'Init');

        $this->assert->boolean($objT->isLocked())->isFalse();
        $this->assert->variable($objT->lock())->isNull();
        $this->assert->boolean($objT->isLocked())->isTrue();
        $this->assert->variable($objT->unlock())->isNull();
        $this->assert->boolean($objT->isLocked())->isFalse();
        $this->assert->variable($objT->updateText('My content'))->isNull();
        $this->string($objT->getText())->isEqualTo('My content');
    }

    public function testLockeOnLockedState()
    {
        $objT = ObjT::make('Id', 'Init');

        $this->assert->boolean($objT->isLocked())->isFalse();
        $this->assert->variable($objT->lock())->isNull();

        $this->assert->boolean($objT->isLocked())->isTrue();
        $this->assert->exception(function () use ($objT) {
            $objT->lock();
        })->isInstanceOf('Exception');
    }

    public function testUnlockeOnInitialState()
    {
        $objT = ObjT::make('Id', 'Init');

        $this->assert->exception(function () use ($objT) {
            $objT->unlock();
        })->isInstanceOf('Exception');

        $this->assert->boolean($objT->isLocked())->isFalse();
    }
}
