<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTranfer;

interface AntelopeRepositoryInterface
{
    /**
     * @return \Pyz\Zed\Antelope\Persistence\Generated\Shared\Transfer\AntelopeCollectionTranfer
     */
    public function getAntelopeCollection(): AntelopeCollectionTranfer;
}
