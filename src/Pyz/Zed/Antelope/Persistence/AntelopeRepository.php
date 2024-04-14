<?php

declare(strict_types=1);

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{
    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        $antelopeEntities = $this->getFactory()->createAntelopeQuery();
        $antelopeEntities->joinWithPyzAntelopeLocation()
            ->joinWithPyzAntelopeType();
        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        $paginationTransfer = $antelopeCriteriaTransfer->getPagination();
        if ($paginationTransfer) {
            $this->applyPagination($paginationTransfer, $antelopeEntities);
        }
        $antelopeCollectionTransfer->setPagination($paginationTransfer);
        $antelopeCollection = $antelopeEntities->find();

        return $this->getFactory()->createAntelopeMapper()
            ->mapAntelopeCollectionToAntelopeCollectionTransfer(
                $antelopeCollection, $antelopeCollectionTransfer
                ,
            );
    }


    public function applyPagination(
        PaginationTransfer $paginationTransfer,
        PyzAntelopeQuery $antelopeEntities
    ): void {
        if ($paginationTransfer->getOffset() !== null && $paginationTransfer->getLimit() > 0) {
            $paginationTransfer->setNbResults($antelopeEntities->count());
            $antelopeEntities->setOffset(+$paginationTransfer->getOffset());
            $antelopeEntities->setLimit(+$paginationTransfer->getLimit());
            return;
        }
        if ($paginationTransfer->getPage() !== null && $paginationTransfer->getMaxPerPage()) {
            $pager = $antelopeEntities->paginate($paginationTransfer->getPage(),
                $paginationTransfer->getMaxPerPage());
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
