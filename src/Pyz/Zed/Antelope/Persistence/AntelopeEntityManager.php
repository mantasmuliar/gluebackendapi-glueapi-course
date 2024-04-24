<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Pyz\Zed\Antelope\Persistence\Propel\Mapper\AntelopeMapper;
use Pyz\Zed\Antelope\Persistence\Propel\Mapper\AntelopeMapperInterface;

class AntelopeEntityManager implements AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        $antelopeEntity = $this->createAntelopeMapper()
            ->mapAntelopeTransferToAntelopeEntity($antelopeTransfer,
                new PyzAntelope());
        $antelopeEntity->save();
        return $this->createAntelopeMapper()
            ->mapAntelopeEntityToAntelopeTransfer($antelopeEntity,
                $antelopeTransfer);
    }

    protected function createAntelopeMapper(): AntelopeMapperInterface
    {
        return new AntelopeMapper();
    }
}
