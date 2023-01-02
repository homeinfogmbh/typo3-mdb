<?php

namespace Homeinfo\mdb\Domain\Repository;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CustomerRepository
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
    }

    public function findById(int $id): QueryResultInterface {
        $queryBuilder = $this->select();
        return $queryBuilder
            ->where(
                $queryBuilder->expr()->eq(
                    'id',
                    $queryBuilder->createNamedParameter($id, Connection::PARAM_INT)
                )
            )
            ->executeQuery()
            ->fetch();
    }

    public function list(): QueryResultInterface {
        return $this->select()->executeQuery()->fetchAll();
    }

    private function select(): QueryBuilder {
        return $this
            ->connectionPool
            ->getQueryBuilderForTable('customer')
            ->select('*')
            ->from('customer')
            ->join(
                'customer',
                'company',
                'company',
                $queryBuilder->expr()->eq('company.id', $queryBuilder->quoteIdentifier('customer.company'))
            )
            ->join(
                'company',
                'address',
                'address',
                $queryBuilder->expr()->eq('address.id', $queryBuilder->quoteIdentifier('company.address'))
            );
    }
}
