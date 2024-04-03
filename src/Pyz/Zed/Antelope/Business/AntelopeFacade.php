<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Pyz\Zed\Antelope\Business\AntelopeCollectionTransfer
     * @api
     *
     */
    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        return $this->getFactory()->createAntelopeReader()->getAntelopeCollection($antelopeCriteriaTransfer);
    }
}
