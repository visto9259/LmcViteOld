<?php

declare(strict_types=1);

namespace LmcTest\Vite\Manifest;

use Lmc\Vite\Manifest\Manifest;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class ManifestTest extends TestCase
{
    public function testCreateDev(): void
    {
        $this->expectNotToPerformAssertions();
        $manifest = new Manifest(
            true,
            __DIR__ . '/../Assets/manifest.json',
            '/dist/'
        );
    }

    public function testCreateNotDev(): void
    {
        $this->expectNotToPerformAssertions();
        $manifest = new Manifest(
            false,
            __DIR__ . '/../Assets/manifest.json',
            '/dist/'
        );
    }

    public function testCreateNonReadableManifestFile(): void
    {
        $this->expectException(RuntimeException::class);
        $manifest = new Manifest(
            false,
            __DIR__ . '/../Assets/manifest-not-readable.json',
            '/dist/'
        );
    }
}
