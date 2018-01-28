<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class InfosUtilesRepository extends EntityRepository
{
    public function findAllWithStatus()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->leftJoin('a.status', 's')
            ->addSelect('s');

        return $qb
            ->getQuery()
            ->getResult();
    }
}