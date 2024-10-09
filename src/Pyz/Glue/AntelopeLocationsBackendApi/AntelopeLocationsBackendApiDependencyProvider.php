<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class AntelopeLocationsBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';

    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);

        $this->addAntelopeLocationFacade($container);

        return $container;
    }

    /**
     * @return void
     */
    private function addAntelopeLocationFacade(Container $container): void
    {
        $container->set(
            static::FACADE_ANTELOPE_LOCATION,
            static function (Container $container): AntelopeLocationFacadeInterface {
                return $container->getLocator()->antelopeLocation()->facade();
            },
        );
    }
}
