<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;
use Pyz\Glue\AntelopeLocationsBackendApi\Controller\AntelopeLocationsResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopeLocationBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS;
    }

    public function getController(): string
    {
        return AntelopeLocationsResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $collection = new GlueResourceMethodCollectionTransfer();
        $method = new GlueResourceMethodConfigurationTransfer();
        $attributes = AntelopeLocationsBackendApiAttributesTransfer::class;
        $method->setAttributes($attributes);

        $collection->setGetCollection($method);

        $collection->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPut((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setDelete(new GlueResourceMethodConfigurationTransfer());

        return $collection;
    }
}
