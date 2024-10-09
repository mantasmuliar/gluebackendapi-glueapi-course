<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;

class ResponseBuilder implements ResponseBuilderInterface
{
    public function createAntelopeLocationResponse(
        AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer,
    ): GlueResponseTransfer {
        $glueResponseTransfer = $this->createGlueResponseTransfer();
        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $antelopeLocationTransfer) {
            $glueResponseTransfer->addResource(
                $this->mapAntelopeLocationTransferToGlueResourceTransfer($antelopeLocationTransfer),
            );
        }
        $glueResponseTransfer->setPagination($antelopeLocationCollectionTransfer->getPagination());

        return $glueResponseTransfer;
    }

    private function mapAntelopeLocationTransferToGlueResourceTransfer(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): GlueResourceTransfer {
        $resourceTransfer = new GlueResourceTransfer();
        $resourceTransfer->setType(AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS);
        $resourceTransfer->setId((string)$antelopeLocationTransfer->getIdAntelopeLocation());
        $resourceTransfer->setAttributes(
            $this->mapAntelopeLocationToAttributesTransfer($antelopeLocationTransfer),
        );

        return $resourceTransfer;
    }

    private function mapAntelopeLocationToAttributesTransfer(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationsBackendApiAttributesTransfer {
        return (new AntelopeLocationsBackendApiAttributesTransfer())
            ->fromArray($antelopeLocationTransfer->toArray(), true);
    }

    private function createGlueResponseTransfer(): GlueResponseTransfer
    {
        return new GlueResponseTransfer();
    }
}
