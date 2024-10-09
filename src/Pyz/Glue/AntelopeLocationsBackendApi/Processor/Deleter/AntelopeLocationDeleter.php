<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    public function __construct(
        private readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        private readonly ResponseBuilderInterface $responseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())
            ->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $this->antelopeLocationFacade->deleteAntelopeLocation($antelopeLocationTransfer);

        return $this->responseBuilder->createAntelopeLocationResponse(new AntelopeLocationCollectionTransfer());
    }
}
