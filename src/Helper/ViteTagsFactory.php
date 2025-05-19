<?php

declare(strict_types=1);

namespace Lmc\Vite\Helper;

use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\HelperPluginManager;
use Lmc\Vite\Manifest\Manifest;
use Psr\Container\ContainerInterface;

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
        // TODO Add error checking of config
        $manifest = new Manifest(
            $config['vite']['dev'] ?? false,
            $config['vite']['manifest_path'],
            $config['vite']['base_path'],
            $config['vite']['vite_url'],
            $config['vite']['react_plugin'],
        );
        if (! $container instanceof AbstractPluginManager) {
            /** @var HelperPluginManager $container */
            $container = $container->get(HelperPluginManager::class);
        }
        return new ViteTags(
            $manifest,
            $container->get('inlineScript'),
            $container->get('headLink')
        );
    }
}
