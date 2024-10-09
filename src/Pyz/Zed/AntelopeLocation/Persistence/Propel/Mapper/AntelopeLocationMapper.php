<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocation;
use Propel\Runtime\Collection\Collection;

class AntelopeLocationMapper
{
    public function mapEntityToTransfer(
        PyzAntelopeLocation $pyzAntelopeLocation,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $antelopeLocationTransfer->fromArray($pyzAntelopeLocation->toArray(), true);
    }

    public function mapEntityCollectionToCollectionTransfer(
        Collection $antelopeLocationEntities,
        AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer,
    ): AntelopeLocationCollectionTransfer {
        foreach ($antelopeLocationEntities as $pyzAntelopeLocation) {
            /** @var \Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocation $pyzAntelopeLocation */
            $antelopeLocationCollectionTransfer->addAntelopeLocation(
                $this->mapEntityToTransfer($pyzAntelopeLocation, new AntelopeLocationTransfer()),
            );
        }

        return $antelopeLocationCollectionTransfer;
    }

    public function mapTransferToEntity(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        PyzAntelopeLocation $pyzAntelopeLocation,
    ): PyzAntelopeLocation {
        return $pyzAntelopeLocation->fromArray($antelopeLocationTransfer->modifiedToArray());
    }
}
