<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;

class AntelopeLocationExpander implements AntelopeLocationExpanderInterface
{
    public function expandConditionWithFilter(
        AntelopeLocationConditionTransfer $antelopeLocationConditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeLocationConditionTransfer {
        foreach ($glueRequestTransfer->getFilters() as $glueFilterTransfer) {
            if ($glueFilterTransfer->getResource() !== AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS) {
                continue;
            }

            $filterField = $glueFilterTransfer->getField();
            $filterValue = $glueFilterTransfer->getValue();
            if (!$filterValue) {
                continue;
            }

            switch ($filterField) {
                case AntelopeLocationConditionTransfer::ID_ANTELOPE_LOCATION:
                    $antelopeLocationConditionTransfer->setIdAntelopeLocation((int)$filterValue);

                    break;
                case AntelopeLocationConditionTransfer::LOCATION_NAME:
                    $antelopeLocationConditionTransfer->setLocationName($filterValue);

                    break;
                case AntelopeLocationConditionTransfer::LOCATION_IDS:
                    $ids = $this->getIds($filterValue);
                    $antelopeLocationConditionTransfer->setLocationIds($ids);

                    break;
            }
        }

        return $antelopeLocationConditionTransfer;
    }

    /**
     * @param array<string>|string $filterValue
     *
     * @return array<int>
     */
    private function getIds(string|array $filterValue): array
    {
        if (is_string($filterValue)) {
            $filterValue = explode(',', $filterValue);
        }

        return array_map(
            'intval',
            array_filter(
                $filterValue,
                static fn (string $item) => is_numeric(trim($item)),
            ),
        );
    }
}
