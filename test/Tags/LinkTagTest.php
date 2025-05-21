<?php

declare(strict_types=1);

namespace LmcTest\Vite\Tags;

use Lmc\Vite\Tags\LinkTag;
use PHPUnit\Framework\TestCase;

final class LinkTagTest extends TestCase
{
    public function testDefault(): void
    {
        $tag = new LinkTag('foo.css');
        $this->assertEquals('foo.css', $tag->href);
        $this->assertEquals('screen', $tag->media);
        $this->assertEquals('', $tag->conditionalStyleSheet);
        $this->assertEquals([], $tag->extras);
    }

    public function testWithExtras(): void
    {
        $tag = new LinkTag('foo.css', 'print', 'foo', ['rel' => 'stylesheet', 'type' => 'text/css']);
        $this->assertEquals('foo.css', $tag->href);
        $this->assertEquals('print', $tag->media);
        $this->assertEquals('foo', $tag->conditionalStyleSheet);
        $this->assertEquals(['rel' => 'stylesheet', 'type' => 'text/css'], $tag->extras);
    }
}
