<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;

interface AntelopeFacadeInterface
{
    /**
     * @api
     *
     * @return \Pyz\Zed\Antelope\Business\AntelopeCollectionTransfer
     */
    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeCollectionTransfer;
}
