<?php

namespace Raichev\TwigTurboBundle\Twig;

use Raichev\TwigTurboBundle\util\LoadingStrategy;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TemplateWrapper;
use Twig\TwigFunction;

class TurboFrameExtension extends AbstractExtension
{

    public function __construct(
        private readonly LoadingStrategy $loading,
        private readonly bool $autoscroll,
        private readonly bool $disabled,
        private readonly bool $withContext,
    )
    {
    }


    public function getFunctions(): iterable
    {
        yield new TwigFunction(
                'turboFrame',
                [$this, 'turboFrame'],
                ['needs_environment' => true, 'needs_context' => true, 'is_safe' => ['all']]
            );
    }

    /**
     * @throws LoaderError
     */
    public function turboFrame(
        Environment $env,
        $context,
        array|string|TemplateWrapper $template,
        array $variables,
        string $loading = null, // Enums are not supported in twig yet
        bool $autoscroll = null,
        bool $disabled = null,
        bool $withContext = null,
    ): string {
        $loading = $loading ? LoadingStrategy::from($loading) : $this->loading;
        $autoscroll ??= $this->autoscroll;
        $disabled ??= $this->disabled;
        $withContext ??= $this->withContext;

        $variables = array_merge($variables, ['loading' => $loading->value, 'autoscroll' => $autoscroll, 'disabled' => $disabled], ['twig_turbo_placeholder' => true]);

        return twig_include($env, $context, $template, $variables, $withContext);
    }

}
