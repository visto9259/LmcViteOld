<?php

declare(strict_types=1);

namespace LmcTest\Vite\Tags;

use Lmc\Vite\Tags\ScriptTag;
use PHPUnit\Framework\TestCase;

class ScriptTagTest extends TestCase
{
    public function testDefault(): void
    {
        $tag = new ScriptTag('foo.js');
        $this->assertEquals('foo.js', $tag->srcOrScript);
        $this->assertEquals('text/javascript', $tag->getType());
        $this->assertEquals([], $tag->getAttrs());
        $this->assertFalse($tag->isInline());
    }

    public function testWithOptions(): void
    {
        $tag = new ScriptTag('foo.js', true, 'text/css', ['async' => true]);
        $this->assertEquals('foo.js', $tag->srcOrScript);
        $this->assertEquals('text/css', $tag->getType());
        $this->assertEquals(['async' => true], $tag->getAttrs());
        $this->assertTrue($tag->isInline());
    }
}
