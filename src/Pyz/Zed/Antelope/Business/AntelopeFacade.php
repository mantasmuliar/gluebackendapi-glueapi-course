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
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Pyz\Zed\Antelope\Business\AntelopeCollectionTransfer
     */
    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeCollectionTransfer
    {
        return $this->getFactory()->createAntelopeReader()->getAntelopeCollection($antelopeCriteriaTransfer);
    }
}
