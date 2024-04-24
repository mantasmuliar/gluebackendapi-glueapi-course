<?php

namespace Pyz\Glue\AntelopesBackendApi\Updater;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapperInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        protected readonly AntelopeMapperInterface $antelopeMapper
    ) {
    }

    public function updateAntelope(
        AntelopesBackendApiAttributesTransfer $antelopesBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeTransfer = $this->antelopeMapper->mapAntelopesBackendApiAttributesToAntelopeTransfer(
            $antelopesBackendApiAttributesTransfer,
            new AntelopeTransfer());
        $antelopeTransfer = $this->antelopeFacade->updateAntelope($antelopeTransfer);
        $antelopeCollectionTransfer = (new AntelopeCollectionTransfer())->addAntelope($antelopeTransfer);
        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollectionTransfer);
    }
}
