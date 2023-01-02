<?php

namespace Homeinfo\mdb\Domain\Repository;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

class CustomerRepository
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
    }

    public function findById(int $id): array {
        return ($queryBuilder = $this->select())
            ->where(
                $queryBuilder->expr()->eq(
                    'id',
                    $queryBuilder->createNamedParameter($id, Connection::PARAM_INT)
                )
            )
            ->executeQuery()
            ->fetch();
    }

    public function list(): array {
        return $this->select()->executeQuery()->fetchAll();
    }

    private function select(): QueryBuilder {
        return ($queryBuilder = $this->connectionPool->getQueryBuilderForTable('customer'))
            ->select('*')
            ->from('customer')
            ->join(
                'customer',
                'company',
                'company',
                $queryBuilder->expr()->eq('company.id', $queryBuilder->quoteIdentifier('customer.company'))
            )
            ->leftJoin(
                'company',
                'address',
                'address',
                $queryBuilder->expr()->eq('address.id', $queryBuilder->quoteIdentifier('company.address'))
            );
    }
}
