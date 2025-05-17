<?php

declare(strict_types=1);

namespace Lmc\Vite\Helper;

use Laminas\View\Helper\AbstractHelper;
use Laminas\View\Helper\HeadLink;
use Laminas\View\Helper\InlineScript;
use Lmc\Vite\Manifest\Manifest;

class ViteTags extends AbstractHelper
{
    protected bool $dev            = false;
    protected string $viteUrl      = 'http://localhost:5173/';
    protected bool $reactPlugin    = false;
    protected string $basePath     = '/dist/';
    protected string $manifestPath = '';

    public function __construct(
        private readonly Manifest $manifest,
        private readonly InlineScript $inlineScriptHelper,
        private readonly HeadLink $headLinkHelper
    ) {
    }

    public function __invoke(string ...$entries): self
    {
        $tags = $this->manifest->createTags(...$entries);
        foreach ($tags->js as $tag) {
            if ($tag->isInline) {
                $this->inlineScriptHelper->appendScript($tag->srcOrScript, $tag->type, $tag->attrs);
            } else {
                $this->inlineScriptHelper->appendFile($tag->srcOrScript, $tag->type, $tag->attrs);
            }
        }

        foreach ($tags->css as $css) {
            $this->headLinkHelper->appendStylesheet($css->href, $css->media, $css->conditionalStyleSheet, $css->extras);
        }

        return $this;
    }
}
