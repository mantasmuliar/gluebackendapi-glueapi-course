<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeReader implements AntelopeReaderInterface
{

    public function __construct(private readonly AntelopeFacadeInterface $antelopeFacade)
    {
    }

    public function getAntelopeCollection(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopes = $this->antelopeFacade
            ->getAntelopeCollection($antelopeCriteriaTransfer)->getAntelopes();
        $responseTransfer = new GlueResponseTransfer();
        foreach ($antelopes as $antelope) {
            $resource = new GlueResourceTransfer();
            $resource->setType(AntelopesBackendApiConfig::RESOURCE_ANTELOPES);
            $resource->setId('' . $antelope->getIdAntelope());
            $attributes = new AntelopesBackendApiAttributesTransfer();
            $attributes->fromArray($antelope->toArray(), true);

            $resource->setAttributes($attributes);
            $responseTransfer->addResource($resource);
        }

        return $responseTransfer;
    }
}
