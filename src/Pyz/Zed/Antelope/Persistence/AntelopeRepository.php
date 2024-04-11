<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{
    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeCollectionTransfer
    {
        $antelopeEntities = $this->getFactory()->createAntelopeQuery();
        $antelopeEntities->joinWithPyzAntelopeLocation()
            ->joinWithPyzAntelopeType();
        $antelopeCollection = $antelopeEntities->find();

        return $this->getFactory()->createAntelopeMapper()
            ->mapAntelopeCollectionToAntelopeCollectionTransfer(
                $antelopeCollection,
                new AntelopeCollectionTransfer(),
            );
    }
}
