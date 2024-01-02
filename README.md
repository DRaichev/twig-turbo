# twig-turbo
Opinionated extension for Symfony UX Turbo.

This bundle is meant to be used alongside Symfony UX Turbo and provides a fast, simple and efficient way to create turbo frames

## Simple example: 
1) We create the frame template ("myFrame.html.twig"), by extending the base and setting the frameId & frameSrc
```twig
{% extends 'turbo_frame_base.html.twig' %}

{% set frameId = 'my-frame' %}
{% set frameSrc = path('app_controller_myframe') %}

{% block content %}
    <div>
        My Template Content
    </div>
{% endblock %}
```  
2) We load the frame in twig using the turboFrame function, passing the frame template as the first argument
```twig
{{ turboFrame('myFrame.html.twig'}}
```  
3) In the controller method we render the frame
```php
    #[Route('/myframe', name: 'myframe', methods: ['GET'])]
    public function myFrame(): Response
    {
        return $this->render(
            'myFrame.html.twig',
        );
    }
```  

By default, the "placeholder" block contains a loading indicator, but if you want a different placeholder in your frame you can override it in step 2

The turboFrame function accepts a few optional arguments:
- 'variables' => variables passed to the twig template
- 'loading' => sets the turbo frame attribute of the same name, ['lazy' | 'eager'], 'eager' by default
- 'autoscroll' => sets the turbo frame attribute of the same name, false by default
- 'disabled' => sets the turbo frame attribute of the same name, false by default
- 'withContext' => when true the twig template can access its parent's variables, false by default

The default values above can be changed via the bundle config
