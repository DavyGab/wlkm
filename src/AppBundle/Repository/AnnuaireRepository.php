<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AnnuaireRepository extends EntityRepository
{
    public function getAnnuaireWithBornes($annuaireID)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->leftJoin('a.annuaireBorne', 'ab')
            ->addSelect('ab')
            
            ->leftJoin('ab.borne', 'b')
            ->addSelect('b')
            ->where('a.id = :annuaireID')
            ->setParameter('annuaireID', $annuaireID);

        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getBornesByAnnuaire($annuaireId)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->leftJoin('a.annuaireBorne', 'ab')
            ->leftJoin('ab.borne', 'b')
            ->addSelect('b');

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
}