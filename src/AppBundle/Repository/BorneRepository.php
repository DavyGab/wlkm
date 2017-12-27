<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

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
}