<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BorneRepository extends EntityRepository
{
    public function getBorneWithAnnuaires()
    {
        $qb = $this
            ->createQueryBuilder('b')
            ->leftJoin('b.annuaireBorne', 'ab')
            ->leftJoin('ab.annuaire', 'a')
            ->addSelect('a');

        return $qb
            ->getQuery()
            ->getResult();
    }

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

    public function findDistinctCity()
    {
        $qb = $this
            ->createQueryBuilder('b')
            ->addselect('COUNT(b) as number')
            ->groupBy('b.ville');

        return $qb
            ->getQuery()
            ->getResult();
    }
}