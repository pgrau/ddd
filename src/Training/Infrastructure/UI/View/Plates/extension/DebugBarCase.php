<?php

namespace Training\Infrastructure\Ui\View\Plates\Extension;

use DebugBar\JavascriptRenderer;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class DebugBar implements ExtensionInterface
{
    private $javascriptRenderer;

    public function __construct(JavascriptRenderer $javascriptRenderer)
    {
        $this->javascriptRenderer = $javascriptRenderer;
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('debugbarHead', [$this, 'debugbarHead']);
        $engine->registerFunction('debugbarRender', [$this, 'debugbarRender']);
    }

    public function debugbarHead()
    {
        return <<<ASSETS
<link rel="stylesheet" type="text/css" href="/component/DebugBar/Resources/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/component/DebugBar/Resources/vendor/highlightjs/styles/github.css">
<link rel="stylesheet" type="text/css" href="/component/DebugBar/Resources/debugbar.css">
<link rel="stylesheet" type="text/css" href="/component/DebugBar/Resources/widgets.css">
<link rel="stylesheet" type="text/css" href="/component/DebugBar/Resources/openhandler.css">
<script type="text/javascript" src="/component/DebugBar/Resources/vendor/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/component/DebugBar/Resources/vendor/highlightjs/highlight.pack.js"></script>
<script type="text/javascript" src="/component/DebugBar/Resources/debugbar.js"></script>
<script type="text/javascript" src="/component/DebugBar/Resources/widgets.js"></script>
<script type="text/javascript" src="/component/DebugBar/Resources/openhandler.js"></script>
<script type="text/javascript">jQuery.noConflict(true);</script>
ASSETS;

    }

    public function debugbarRender()
    {
        return $this->javascriptRenderer->render();
    }
}
