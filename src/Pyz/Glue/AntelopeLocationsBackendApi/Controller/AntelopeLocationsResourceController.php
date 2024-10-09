<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractBackendApiController;

/**
 * @method \Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiFactory getFactory()
 */
class AntelopeLocationsResourceController extends AbstractBackendApiController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->getAntelopeLocationCollection($glueRequestTransfer);
    }

    public function getAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->getAntelopeLocation($glueRequestTransfer);
    }

    public function postAction(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        return $this->getFactory()
            ->createAntelopeLocationWriter()
            ->createAntelopeLocation($antelopeLocationsBackendApiAttributesTransfer);
    }

    public function putAction(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        return $this->getFactory()
            ->createAntelopeLocationWriter()
            ->updateAntelopeLocation($antelopeLocationsBackendApiAttributesTransfer, $glueRequestTransfer);
    }

    public function deleteAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationDeleter()
            ->deleteAntelopeLocation($glueRequestTransfer);
    }
}
