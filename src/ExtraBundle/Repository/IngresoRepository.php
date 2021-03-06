<?php

namespace ExtraBundle\Repository;

/**
 * IngresoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IngresoRepository extends \Doctrine\ORM\EntityRepository
{
    public function buscarPorAtributos($ingreso){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('ingreso')
                ->from($this->getEntityName(), 'ingreso');
        $this->addSearchParameters($qb, $ingreso);
        return $qb->getQuery()->getResult();
    }

    public function addSearchParameters($qb, $ingreso){
        if($ingreso){
            $qb->where($qb->expr()->like('ingreso.username', ':username'));
            $qb->setParameter('username', "%{$ingreso}%");
        }
    }
}
