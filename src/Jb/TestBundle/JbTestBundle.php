<?php

namespace Jb\TestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Broadway\Bundle\BroadwayBundle\DependencyInjection\RegisterBusSubscribersCompilerPass;

class JbTestBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new RegisterBusSubscribersCompilerPass(
                'jb_test.event_handling.event_bus',
                'jb_test.domain.event_listener',
                'Broadway\EventHandling\EventListenerInterface'
            )
        );
    }
}
