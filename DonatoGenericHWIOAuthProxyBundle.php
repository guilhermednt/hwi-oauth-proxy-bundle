<?php

namespace Donato\Generic\HWIOAuthProxyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Donato\Generic\HWIOAuthProxyBundle\DependencyInjection\Compiler\ProxyConfigCompilerPass;

class DonatoGenericHWIOAuthProxyBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ProxyConfigCompilerPass());
    }

    public function getParent()
    {
        return 'HWIOAuthBundle';
    }

}
