<?php

namespace CuentaBundle\Repository;

/**
 * CuentaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CuentaRepository extends \Doctrine\ORM\EntityRepository
{
    public function buscarPorAtributos($cuenta){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('cuenta')
                ->from($this->getEntityName(), 'cuenta');
        $this->addSearchParameters($qb, $cuenta);
        return $qb->getQuery()->getResult();
    }

    public function addSearchParameters($qb, $cuenta){
        if($cuenta){
            $qb->where($qb->expr()->like('cuenta.username', ':username'));
            $qb->setParameter('username', "%{$cuenta}%");
        }
    }
}
