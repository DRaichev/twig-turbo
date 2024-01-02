<?php

declare(strict_types=1);

namespace Raichev\TwigTurboBundle\util;


enum LoadingStrategy: string
{
    case EAGER = 'eager';
    case LAZY = 'lazy';
}
