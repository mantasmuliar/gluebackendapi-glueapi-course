<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationWriter implements AntelopeLocationWriterInterface
{
    public function __construct(
        private readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        private readonly ResponseBuilderInterface $responseBuilder,
    ) {
    }

    public function createAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->mapBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationsBackendApiAttributesTransfer,
        );
        $antelopeLocationTransfer = $this->antelopeLocationFacade->createAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer = $this->createAntelopeLocationCollectionTransfer()
            ->addAntelopeLocation($antelopeLocationTransfer);

        return $this->responseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }

    public function updateAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationTransfer = $this->mapBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationsBackendApiAttributesTransfer,
        );
        $antelopeLocationTransfer->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()->getId());
        $antelopeLocationCollectionTransfer = $this->createAntelopeLocationCollectionTransfer();
        if (!$this->validateRequiredFields($antelopeLocationTransfer)) {
            return $this->responseBuilder
                ->createAntelopeLocationResponse($antelopeLocationCollectionTransfer)
                ->setHttpStatus(Response::HTTP_BAD_REQUEST);
        }

        $antelopeLocationTransfer = $this->antelopeLocationFacade->updateAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer->addAntelopeLocation($antelopeLocationTransfer);

        return $this->responseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }

    private function validateRequiredFields(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        try {
            $antelopeLocationTransfer
                ->requireIdAntelopeLocation()
                ->requireLocationName()
                ->requireDescription()
                ->requireLatitude()
                ->requireLongitude();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }

    private function mapBackendApiAttributesToAntelopeLocationTransfer(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
    ): AntelopeLocationTransfer {
        return (new AntelopeLocationTransfer())
            ->fromArray($antelopeLocationsBackendApiAttributesTransfer->toArray(), true);
    }

    private function createAntelopeLocationCollectionTransfer(): AntelopeLocationCollectionTransfer
    {
        return new AntelopeLocationCollectionTransfer();
    }
}
