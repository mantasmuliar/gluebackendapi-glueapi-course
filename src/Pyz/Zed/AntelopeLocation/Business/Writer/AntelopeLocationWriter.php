<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business\Writer;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;

class AntelopeLocationWriter implements AntelopeLocationWriterInterface
{
    public function __construct(
        private readonly AntelopeLocationEntityManagerInterface $entityManager,
    ) {
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $this->entityManager->createAntelopeLocation($antelopeLocationTransfer);
    }

    public function updateAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        $antelopeLocationTransfer->requireIdAntelopeLocation();

        return $this->entityManager->updateAntelopeLocation($antelopeLocationTransfer);
    }
}
