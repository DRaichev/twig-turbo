<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use Raichev\TwigTurboBundle\Twig\TurboFrameExtension;

return function (ContainerConfigurator $container) {
    $container->services()
        ->set(TurboFrameExtension::class, TurboFrameExtension::class)
        ->args([
            abstract_arg('loading'),
            abstract_arg('autoscroll'),
            abstract_arg('disabled'),
            abstract_arg('withContext'),
        ])
        ->tag('twig.extension')
        ->alias('twig_turbo.twig.turbo_frame_extension', TurboFrameExtension::class);
};
