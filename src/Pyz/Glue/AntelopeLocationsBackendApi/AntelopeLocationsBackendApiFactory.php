<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleter;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleterInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpander;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReader;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReaderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer\AntelopeLocationWriter;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer\AntelopeLocationWriterInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractBackendApiFactory;

class AntelopeLocationsBackendApiFactory extends AbstractBackendApiFactory
{
    public function createAntelopeLocationReader(): AntelopeLocationReaderInterface
    {
        return new AntelopeLocationReader(
            $this->getAntelopeLocationFacade(),
            $this->createResponseBuilder(),
            $this->createAntelopeLocationExpander(),
        );
    }

    public function createAntelopeLocationWriter(): AntelopeLocationWriterInterface
    {
        return new AntelopeLocationWriter(
            $this->getAntelopeLocationFacade(),
            $this->createResponseBuilder(),
        );
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleterInterface
    {
        return new AntelopeLocationDeleter(
            $this->getAntelopeLocationFacade(),
            $this->createResponseBuilder(),
        );
    }

    public function createAntelopeLocationExpander(): AntelopeLocationExpanderInterface
    {
        return new AntelopeLocationExpander();
    }

    public function createResponseBuilder(): ResponseBuilderInterface
    {
        return new ResponseBuilder();
    }

    public function getAntelopeLocationFacade(): AntelopeLocationFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationsBackendApiDependencyProvider::FACADE_ANTELOPE_LOCATION);
    }
}
