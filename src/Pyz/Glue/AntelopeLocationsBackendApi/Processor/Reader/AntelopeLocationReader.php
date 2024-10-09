<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        private readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        private readonly ResponseBuilderInterface $responseBuilder,
        private readonly AntelopeLocationExpanderInterface $antelopeLocationExpander,
    ) {
    }

    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = $this->createAntelopeLocationCriteriaTransfer();
        $conditionTransfer = $this->createAntelopeLocationConditionTransfer();
        $conditionTransfer->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $antelopeLocationCriteriaTransfer->setAntelopeLocationCondition($conditionTransfer);

        $glueResponseTransfer = $this->getAntelopeLocationCollectionByCriteria($antelopeLocationCriteriaTransfer);
        if (!$glueResponseTransfer->getResources()->count()) {
            $glueResponseTransfer->setHttpStatus(Response::HTTP_NOT_FOUND);
        }

        return $glueResponseTransfer;
    }

    public function getAntelopeLocationCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = $this->createAntelopeLocationCriteriaTransfer();
        $conditionTransfer = $this->createAntelopeLocationConditionTransfer();
        $this->antelopeLocationExpander->expandConditionWithFilter($conditionTransfer, $glueRequestTransfer);
        $antelopeLocationCriteriaTransfer
            ->setAntelopeLocationCondition($conditionTransfer)
            ->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings());

        return $this->getAntelopeLocationCollectionByCriteria($antelopeLocationCriteriaTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer
     */
    private function createAntelopeLocationCriteriaTransfer(): AntelopeLocationCriteriaTransfer
    {
        return new AntelopeLocationCriteriaTransfer();
    }

    /**
     * @return \Generated\Shared\Transfer\AntelopeLocationConditionTransfer
     */
    private function createAntelopeLocationConditionTransfer(): AntelopeLocationConditionTransfer
    {
        return new AntelopeLocationConditionTransfer();
    }

    private function getAntelopeLocationCollectionByCriteria(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCollectionTransfer = $this->antelopeLocationFacade
            ->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);

        return $this->responseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }
}
