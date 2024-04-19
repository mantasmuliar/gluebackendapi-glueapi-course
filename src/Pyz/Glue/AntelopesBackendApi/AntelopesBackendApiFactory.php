<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi;

use Pyz\Glue\AntelopesBackendApi\Processor\Expander\AntelopesExpander;
use Pyz\Glue\AntelopesBackendApi\Processor\Expander\AntelopesExpanderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Reader\AntelopeReader;
use Pyz\Glue\AntelopesBackendApi\Processor\Reader\AntelopeReaderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilder;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

class AntelopesBackendApiFactory extends AbstractFactory
{
    public function createAntelopesReader(): AntelopeReaderInterface
    {
        return new AntelopeReader(
            $this->getAntelopeFacade(),
            $this->createAntelopeResponseBuilder(),
            $this->createAntelopesExpander(),
        );
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopesBackendApiDependencyProvider::FACADE_ANTELOPE);
    }

    public function createAntelopeResponseBuilder(): AntelopeResponseBuilderInterface
    {
        return new AntelopeResponseBuilder();
    }

    public function createAntelopesExpander(): AntelopesExpanderInterface
    {
        return new AntelopesExpander();
    }
}
