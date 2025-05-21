<?php

declare(strict_types=1);

namespace LmcTest\Vite\Tags;

use Lmc\Vite\Tags\LinkTag;
use Lmc\Vite\Tags\ScriptTag;
use Lmc\Vite\Tags\Tags;
use PHPUnit\Framework\TestCase;

class TagsTest extends TestCase
{
    public function testDefault(): void
    {
        $tags = new Tags();
        $this->assertEquals([], $tags->preload);
        $this->assertEquals([], $tags->css);
        $this->assertEquals([], $tags->js);
    }

    public function testWithOptions(): void
    {
        $tags = new Tags(
            ['foo.js'],
            [new LinkTag('foo.css')],
            [new ScriptTag('foo.js')]
        );
        $this->assertEquals(['foo.js'], $tags->preload);
        $this->assertIsArray($tags->css);
        $this->assertIsArray($tags->js);
    }
}
