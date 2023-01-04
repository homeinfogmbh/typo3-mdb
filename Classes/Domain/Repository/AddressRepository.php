<?php

namespace Homeinfo\mdb\Domain\Repository;

use Generator;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

use Homeinfo\mdb\Domain\Model\Address;

class AddressRepository
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
    }

    public function getMap(): array {
        $map = [];

        foreach ($this->list() as &$address)
        {
            $map[$address->id] = $address;
        }

        return $map;
    }

    public function get(int $id): Address {
        return Address::fromArray($this->findById($id));
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
            yield Address::fromArray($record);
        }
    }

    private function select(): QueryBuilder {
        return $this->connectionPool->getQueryBuilderForTable('address')
            ->select('*')
            ->from('address');
    }
}
