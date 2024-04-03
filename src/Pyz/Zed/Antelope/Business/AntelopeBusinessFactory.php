<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Antelope\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Antelope\Reader\AntelopeReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Antelope\AntelopeConfig getConfig()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Antelope\Business\Antelope\Reader\AntelopeReaderInterface
     */
    public function createAntelopeReader(): AntelopeReaderInterface
    {
        return new AntelopeReader($this->getRepository());
    }
}
