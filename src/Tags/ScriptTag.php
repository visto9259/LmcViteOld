<?php

declare(strict_types=1);

namespace Lmc\Vite\Tags;

final readonly class ScriptTag
{
    public function __construct(
        public string $srcOrScript,
        public bool $isInline = false,
        public string $type = 'text/javascript',
        public array $attrs = [],
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSrcOrScript(): string
    {
        return $this->srcOrScript;
    }

    public function getAttrs(): array
    {
        return $this->attrs;
    }

    public function isInline(): bool
    {
        return $this->isInline;
    }
}
