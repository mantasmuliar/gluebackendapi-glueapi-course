<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\Base\PyzAntelope;
use Propel\Runtime\Collection\ObjectCollection;

class AntelopeMapper implements AntelopeMapperInterface
{
    public function mapAntelopeTransferToAntelopeEntity(
        AntelopeTransfer $antelopeTransfer,
        PyzAntelope $antelope,
    ): PyzAntelope {
        return $antelope->fromArray($antelopeTransfer->toArray());
    }

    public function mapAntelopeCollectionToAntelopeCollectionTransfer(
        ObjectCollection $antelopeCollection,
        AntelopeCollectionTransfer $antelopeCollectionTransfer,
    ): AntelopeCollectionTransfer {
        foreach ($antelopeCollection as $antelope) {
            $antelopeDto = $this->mapAntelopeEntityToAntelopeTransfer($antelope, new AntelopeTransfer());
            $antelopeCollectionTransfer->addAntelope($antelopeDto);
        }

        return $antelopeCollectionTransfer;
    }

    public function mapAntelopeEntityToAntelopeTransfer(
        PyzAntelope $antelope,
        AntelopeTransfer $antelopeTransfer,
    ): AntelopeTransfer {
        return $antelopeTransfer->fromArray($antelope->toArray(), true);
    }
}
