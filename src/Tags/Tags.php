<?php

declare(strict_types=1);

namespace Lmc\Vite\Tags;

final readonly class Tags
{
    /**
     * @param LinkTag[] $css
     * @param ScriptTag[] $js
     */
    public function __construct(
        public array $preload = [],
        public array $css = [],
        public array $js = [],
    ) {
    }
}
