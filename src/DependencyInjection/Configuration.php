<?php

namespace Raichev\TwigTurboBundle\DependencyInjection;

use Raichev\TwigTurboBundle\util\LoadingStrategy;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('twig-turbo-bundle');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->enumNode('loading')
                    ->values(LoadingStrategy::cases())
                    ->defaultValue(LoadingStrategy::EAGER)
                    ->info('loading strategy')
                ->end()
                ->booleanNode('autoscroll')
                    ->defaultFalse()
                    ->info('scroll to element')
                ->end()
                ->booleanNode('disabled')
                    ->defaultFalse()
                    ->info('prevent navigation')
                ->end()
                ->booleanNode('withContext')
                    ->defaultFalse()
                    ->info("allows using parent's variables")
                ->end()
            ->end();

        return $treeBuilder;
    }
}
