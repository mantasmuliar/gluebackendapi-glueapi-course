<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business\Reader;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        private readonly AntelopeLocationRepositoryInterface $repository,
    ) {
    }

    public function getAntelopeLocationCollection(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): AntelopeLocationCollectionTransfer {
        return $this->repository->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
    }
}
