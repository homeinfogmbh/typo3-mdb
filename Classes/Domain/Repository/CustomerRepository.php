<?php

namespace Homeinfo\mdb\Domain\Repository;

use Generator;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

use Homeinfo\mdb\Domain\Model\Customer;

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

    public function list(): Generator {
        foreach ($this->select()->executeQuery()->fetchAll() as &$record)
        {
            yield Customer::fromJoinedRecord($record);
        }
    }

    private function select(): QueryBuilder {
        return ($queryBuilder = $this->connectionPool->getQueryBuilderForTable('customer'))
            ->select(
                'customer.*',
                'company.name AS company_name',
                'company.annotation AS company_annotation',
                'address.id AS address_id',
                'address.street AS address_street',
                'address.house_number AS address_house_number',
                'address.zip_code AS address_zip_code',
                'address.city AS address_city',
                'address.district AS address_district',
            )
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
