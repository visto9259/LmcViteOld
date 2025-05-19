<?php

declare(strict_types=1);

namespace LmcTest\Vite;

use Lmc\Vite\Helper\ViteTags;
use Lmc\Vite\Helper\ViteTagsFactory;
use Lmc\Vite\Module;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Module::class)]
final class ModuleTest extends TestCase
{
    public function testModuleProvidesExpectationConfig(): void
    {
        $module   = new Module();
        $expected = [
            'view_helpers' => [
                'factories' => [
                    ViteTags::class => ViteTagsFactory::class,
                ],
                'aliases'   => [
                    'viteTags' => ViteTags::class,
                    'vitetags' => ViteTags::class,
                    'ViteTags' => ViteTags::class,
                ],
            ],
        ];
        $this->assertEquals($expected, $module->getConfig());
    }
}
