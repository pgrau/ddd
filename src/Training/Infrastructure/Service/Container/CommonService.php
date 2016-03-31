<?php

namespace Training\Infrastructure\Service\Container;

use League\Container\ServiceProvider\AbstractServiceProvider;

class CommonService extends AbstractServiceProvider
{
    protected $provides = [
        'debugbar',
        'template'
    ];

    public function register()
    {
        $this->registerDebugbar();
        $this->registerTemplate();
    }

    private function registerDebugbar()
    {
        $this->getContainer()->add('debugbar', '\DebugBar\StandardDebugBar');
    }

    private function registerTemplate()
    {
        $this->getContainer()->add(
            'template',
            \Training\Infrastructure\UI\View\Plates\getTemplate($this->getContainer())
        );
    }
}
