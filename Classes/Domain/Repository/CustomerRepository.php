<?php

namespace Homeinfo\mdb\Domain\Repository;

use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CustomerRepository
{
    public function findById(int $id): QueryResultInterface {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('customer');
        $result = Self::select($queryBuilder)
            ->where(
                $queryBuilder->expr()->eq(
                    'id',
                    $queryBuilder->createNamedParameter($id, Connection::PARAM_INT)
                )
            )
            ->executeQuery();

        return $result->fetch();
    }

    public function list(): QueryResultInterface {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('customer');
        $result = Self::select($queryBuilder)->executeQuery();
        return $result->fetchAll();
    }

    private static function select(QueryBuilder $queryBuilder): QueryResultInterface {
        return $queryBuilder
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
