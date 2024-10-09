<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;

interface AntelopeLocationRepositoryInterface
{
    public function getAntelopeLocationCollection(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): AntelopeLocationCollectionTransfer;
}
