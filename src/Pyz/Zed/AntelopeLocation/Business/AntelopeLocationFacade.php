<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\AntelopeLocation\Business\AntelopeLocationBusinessFactory getFactory()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface getRepository()
 */
class AntelopeLocationFacade extends AbstractFacade implements AntelopeLocationFacadeInterface
{
    public function getAntelopeLocationCollection(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): AntelopeLocationCollectionTransfer {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $this->getFactory()
            ->createAntelopeLocationWriter()
            ->createAntelopeLocation($antelopeLocationTransfer);
    }

    public function updateAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $this->getFactory()
            ->createAntelopeLocationWriter()
            ->updateAntelopeLocation($antelopeLocationTransfer);
    }

    public function deleteAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): bool {
        return $this->getFactory()
            ->createAntelopeLocationDeleter()
            ->delete($antelopeLocationTransfer);
    }
}
