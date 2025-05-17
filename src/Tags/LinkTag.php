<?php

declare(strict_types=1);

namespace Lmc\Vite\Tags;

final readonly class LinkTag
{
    public function __construct(
        public string $href,
        public string $media = 'screen',
        public string $conditionalStyleSheet = '',
        public array $extras = [],
    ) {
    }
}
