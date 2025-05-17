<?php

declare(strict_types=1);

namespace Lmc\Vite;

use Lmc\Vite\Helper\ViteTags;
use Lmc\Vite\Helper\ViteTagsFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'view_helpers' => $this->getViewHelpConfig(),
        ];
    }

    public function getViewHelpConfig(): array
    {
        return [
            'factories' => [
                ViteTags::class => ViteTagsFactory::class,
            ],
            'aliases'   => [
                'viteTags' => ViteTags::class,
                'vitetags' => ViteTags::class,
                'ViteTags' => ViteTags::class,
            ],
        ];
    }
}
