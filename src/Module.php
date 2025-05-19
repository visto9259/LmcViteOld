<?php

declare(strict_types=1);

namespace Lmc\Vite;

final class Module
{
    public function getConfig(): array
    {
        $configProvider = new ConfigProvider();
        return [
            'view_helpers' => $configProvider->getViewHelpConfig(),
        ];
    }
}
