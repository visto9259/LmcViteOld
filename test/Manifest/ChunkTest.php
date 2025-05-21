<?php

declare(strict_types=1);

namespace LmcTest\Vite\Manifest;

use Lmc\Vite\Manifest\Chunk;
use PHPUnit\Framework\TestCase;

class ChunkTest extends TestCase
{
    public function testConstruct(): void
    {
        $chunk = new Chunk('src', 'name', true, true, 'file', [], [], [], []);
        $this->assertEquals('src', $chunk->src);
        $this->assertEquals('name', $chunk->name);
        $this->assertTrue($chunk->isEntry);
        $this->assertTrue($chunk->isDynamicEntry);
        $this->assertEquals('file', $chunk->file);
        $this->assertEquals([], $chunk->imports);
        $this->assertEquals([], $chunk->css);
        $this->assertEquals([], $chunk->assets);
        $this->assertEquals([], $chunk->dynamicImports);
    }

    public function testCreate(): void
    {
        $chunk = Chunk::create([
            'file' => 'file',
        ]);
        $this->assertEquals(null, $chunk->src);
        $this->assertEquals(null, $chunk->name);
        $this->assertFalse($chunk->isEntry);
        $this->assertFalse($chunk->isDynamicEntry);
        $this->assertEquals('file', $chunk->file);
        $this->assertEquals([], $chunk->imports);
        $this->assertEquals([], $chunk->css);
        $this->assertEquals([], $chunk->assets);
        $this->assertEquals([], $chunk->dynamicImports);
    }
}
