<?php

namespace Raichev\TwigTurboBundle\DependencyInjection;

use Raichev\TwigTurboBundle\Twig\TurboFrameExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RaichevTwigTurboExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../config'));
        $loader->load('TurboFrameExtension.php');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->findDefinition(TurboFrameExtension::class)
            ->setArgument(0, $config['loading'])
            ->setArgument(1, $config['autoscroll'])
            ->setArgument(2, $config['disabled'])
            ->setArgument(3, $config['withContext']);
    }

}
