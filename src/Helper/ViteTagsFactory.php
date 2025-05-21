<?php

declare(strict_types=1);

namespace Lmc\Vite\Helper;

use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\HelperPluginManager;
use Lmc\Vite\Manifest\Manifest;
use Psr\Container\ContainerInterface;

use function is_array;
use function is_bool;
use function is_string;

final class ViteTagsFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ViteTags
    {
        /** @var array $config */
        $config = $container->get('config');
        if (! isset($config['vite'])) {
            throw new ServiceNotCreatedException('Vite configuration not found.');
        }
        if (! is_array($config['vite'])) {
            throw new ServiceNotCreatedException('Vite configuration not found.');
        }
        $config = $config['vite'];
        if (
            (isset($config['dev']) && ! is_bool($config['dev'])) ||
            (isset($config['manifest_path']) && ! is_string($config['manifest_path'])) ||
            (isset($config['base_path']) && ! is_string($config['base_path'])) ||
            (isset($config['vite_url']) && ! is_string($config['vite_url'])) ||
            (isset($config['react_plugin']) && ! is_bool($config['react_plugin'])) ||
            (! isset($config['manifest_path']))
        ) {
            throw new ServiceNotCreatedException('Vite configuration is invalid.');
        }

        $manifest = new Manifest(
            $config['dev'] ?? false,
            $config['manifest_path'],
            $config['base_path'] ?? '/dist/',
            $config['vite_url'] ?? 'http://localhost:5173/',
            $config['react_plugin'] ?? false,
        );
        if (! $container instanceof AbstractPluginManager) {
            /** @var HelperPluginManager $container */
            $container = $container->get(HelperPluginManager::class);
        }

        if (! $container->has('inlineScript') || ! $container->has('headLink')) {
            throw new ServiceNotCreatedException('Vite helper dependencies not found.');
        }

        return new ViteTags(
            $manifest,
            $container->get('inlineScript'),
            $container->get('headLink')
        );
    }
}
