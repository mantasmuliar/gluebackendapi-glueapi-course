<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business\Deleter;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    public function __construct(
        private readonly AntelopeLocationEntityManagerInterface $antelopeLocationEntityManager,
    ) {
    }

    public function delete(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        $antelopeLocationTransfer->requireIdAntelopeLocation();

        return $this->antelopeLocationEntityManager->deleteAntelopeLocation($antelopeLocationTransfer);
    }
}
