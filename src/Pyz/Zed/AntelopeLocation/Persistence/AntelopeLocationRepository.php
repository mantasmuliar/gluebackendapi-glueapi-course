<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationPersistenceFactory getFactory()
 */
class AntelopeLocationRepository extends AbstractRepository implements AntelopeLocationRepositoryInterface
{
    public function getAntelopeLocationCollection(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): AntelopeLocationCollectionTransfer {
        $antelopeLocationCollectionTransfer = new AntelopeLocationCollectionTransfer();
        $antelopeLocationQuery = $this->getFactory()->createAntelopeLocationQuery();
        $this->applySearch($antelopeLocationQuery, $antelopeLocationCriteriaTransfer);
        $this->applySorting($antelopeLocationQuery, $antelopeLocationCriteriaTransfer);
        $paginationTransfer = $antelopeLocationCriteriaTransfer->getPagination();
        if ($paginationTransfer) {
            $this->applyPagination($paginationTransfer, $antelopeLocationQuery);
        }
        $antelopeLocationCollectionTransfer->setPagination($paginationTransfer);

        $antelopeLocationEntities = $antelopeLocationQuery->find();

        return $this->getFactory()
            ->createAntelopeLocationMapper()
            ->mapEntityCollectionToCollectionTransfer(
                $antelopeLocationEntities,
                $antelopeLocationCollectionTransfer,
            );
    }

    /**
     * @return void
     */
    private function applySearch(
        PyzAntelopeLocationQuery $antelopeLocationQuery,
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): void {
        $conditionTransfer = $antelopeLocationCriteriaTransfer->getAntelopeLocationCondition();
        if (!$conditionTransfer) {
            return;
        }

        if ($idAntelopeLocation = $conditionTransfer->getIdAntelopeLocation()) {
            $antelopeLocationQuery->_or()->filterByIdantelopelocation($idAntelopeLocation);
        }

        if ($locationName = $conditionTransfer->getLocationName()) {
            $likePattern = "%$locationName%";
            $antelopeLocationQuery->_or()->filterByLocationName_Like($likePattern);
        }

        if ($locationIds = $conditionTransfer->getLocationIds()) {
            $antelopeLocationQuery->_or()->filterByIdantelopelocation_In($locationIds);
        }
    }

    /**
     * @return void
     */
    protected function applySorting(
        PyzAntelopeLocationQuery $antelopeLocationQuery,
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): void {
        foreach ($antelopeLocationCriteriaTransfer->getSortCollection() as $sortTransfer) {
            $columnName = $sortTransfer->getField();
            $order = $sortTransfer->getIsAscending() ? Criteria::ASC : Criteria::DESC;
            $antelopeLocationQuery->orderBy($columnName, $order);
        }
    }

    /**
     * @return void
     */
    private function applyPagination(
        PaginationTransfer $paginationTransfer,
        PyzAntelopeLocationQuery $antelopeLocationQuery,
    ): void {
        if ($paginationTransfer->getOffset() !== null && $paginationTransfer->getLimit() > 0) {
            $paginationTransfer->setNbResults($antelopeLocationQuery->count());
            $antelopeLocationQuery->setOffset((int)$paginationTransfer->getOffset());
            $antelopeLocationQuery->setLimit((int)$paginationTransfer->getLimit());

            return;
        }

        if ($paginationTransfer->getPage() !== null && $paginationTransfer->getMaxPerPage()) {
            $pager = $antelopeLocationQuery->paginate(
                $paginationTransfer->getPage(),
                $paginationTransfer->getMaxPerPage(),
            );
            $paginationTransfer->setNbResults($pager->getNbResults())
                ->setFirstIndex($pager->getFirstIndex())
                ->setLastIndex($pager->getLastIndex())
                ->setNextPage($pager->getNextPage())
                ->setPreviousPage($pager->getPreviousPage())
                ->setFirstPage($pager->getFirstPage())
                ->setLastPage($pager->getLastPage());
        }
    }
}
