<?php

declare(strict_types=1);

namespace LmcTest\Vite\Helper;

use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\HelperPluginManager;
use Lmc\Vite\Helper\ViteTags;
use Lmc\Vite\Helper\ViteTagsFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ViteTagsFactory::class)]
final class ViteTagsFactoryTest extends TestCase
{
    public function testNoConfig(): void
    {
        $container = new ServiceManager();
        $container->setService('config', []);
        $factory = new ViteTagsFactory();
        $this->expectException(ServiceNotCreatedException::class);
        $factory->__invoke($container, ViteTags::class);
    }

    #[DataProvider('invalidConfigProvider')]
    public function testInvalidConfig(array $config): void
    {
        $container = new ServiceManager();
        $container->setService('config', $config);
        $factory = new ViteTagsFactory();
        $this->expectException(ServiceNotCreatedException::class);
        $factory->__invoke($container, ViteTags::class);
    }

    public function testValidConfig(): void
    {
        $container = new ServiceManager();
        $container->setService(HelperPluginManager::class, new HelperPluginManager($container));
        $container->setService('config', [
            'vite' => [
                'dev'           => true,
                'manifest_path' => 'manifest.json',
                'base_path'     => '/dist/',
            ],
        ]);
        $factory = new ViteTagsFactory();
        $this->assertInstanceOf(ViteTags::class, $factory->__invoke($container, ViteTags::class));
    }

    public static function invalidConfigProvider(): array
    {
        return [
            'no-vite-config'           => ['config' => []],
            'empty-vite-config'        => [
                'config' => [
                    'vite' => [],
                ],
            ],
            'dev-not-bool'             => [
                'config' => [
                    'vite' => [
                        'dev'           => 'foo',
                        'manifest_path' => 'manifest.json',
                        'base_path'     => '/dist/',
                        'vite_url'      => 'http://localhost:5173/',
                        'react_plugin'  => false,
                    ],
                ],
            ],
            'manifest-path-not-string' => [
                'config' => [
                    'vite' => [
                        'dev'           => true,
                        'manifest_path' => true,
                        'base_path'     => '/dist/',
                        'vite_url'      => 'http://localhost:5173/',
                        'react_plugin'  => false,
                    ],
                ],
            ],
            'manifest-not-set'         => [
                'config' => [
                    'vite' => [
                        'dev'          => true,
                        'base_path'    => '/dist/',
                        'vite_url'     => 'http://localhost:5173/',
                        'react_plugin' => false,
                    ],
                ],
            ],
            'base-path-not-string'     => [
                'config' => [
                    'vite' => [
                        'dev'           => true,
                        'manifest_path' => 'foo',
                        'base_path'     => true,
                        'vite_url'      => 'http://localhost:5173/',
                        'react_plugin'  => false,
                    ],
                ],
            ],
            'vite-url-path-not-string' => [
                'config' => [
                    'vite' => [
                        'dev'           => true,
                        'manifest_path' => 'foo',
                        'base_path'     => 'foo',
                        'vite_url'      => true,
                        'react_plugin'  => false,
                    ],
                ],
            ],
            'react-plugin-not-bool'    => [
                'config' => [
                    'vite' => [
                        'dev'           => true,
                        'manifest_path' => 'foo',
                        'base_path'     => '/dist/',
                        'vite_url'      => 'http://localhost:5173/',
                        'react_plugin'  => 'foo',
                    ],
                ],
            ],
        ];
    }
}
