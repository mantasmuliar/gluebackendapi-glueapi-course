<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationReaderInterface
{
    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;

    public function getAntelopeLocationCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer;
}
