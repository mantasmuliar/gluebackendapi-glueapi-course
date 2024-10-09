<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocation;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationPersistenceFactory getFactory()
 */
class AntelopeLocationEntityManager extends AbstractEntityManager implements AntelopeLocationEntityManagerInterface
{
    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        $pyzAntelopeLocation = $this->getFactory()
            ->createAntelopeLocationMapper()
            ->mapTransferToEntity($antelopeLocationTransfer, new PyzAntelopeLocation());

        $pyzAntelopeLocation->save();

        return $this->getFactory()
            ->createAntelopeLocationMapper()
            ->mapEntityToTransfer($pyzAntelopeLocation, $antelopeLocationTransfer);
    }

    public function updateAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        $pyzAntelopeLocation = $this->getFactory()
            ->createAntelopeLocationQuery()
            ->filterByIdAntelopeLocation($antelopeLocationTransfer->getIdAntelopeLocation())
            ->findOne();

        $pyzAntelopeLocation = $this->getFactory()
            ->createAntelopeLocationMapper()
            ->mapTransferToEntity($antelopeLocationTransfer, $pyzAntelopeLocation);
        $pyzAntelopeLocation->save();

        return $this->getFactory()
            ->createAntelopeLocationMapper()
            ->mapEntityToTransfer($pyzAntelopeLocation, $antelopeLocationTransfer);
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        $pyzAntelopeLocation = $this->getFactory()
            ->createAntelopeLocationQuery()
            ->filterByIdAntelopeLocation($antelopeLocationTransfer->getIdAntelopeLocation())
            ->findOne();

        $pyzAntelopeLocation->delete();

        return $pyzAntelopeLocation->isDeleted();
    }
}
