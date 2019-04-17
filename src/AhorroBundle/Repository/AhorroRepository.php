<?php

namespace AhorroBundle\Repository;
class AhorroRepository extends \Doctrine\ORM\EntityRepository
{
    public function buscarPorAtributos($ahorro){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb ->select('ahorro')
            ->from($this->getEntityName(), 'ahorro');
        $this->addSearchParameters($qb, $ahorro);
        return $qb->getQuery()->getResult();
    }

    public function addSearchParameters($qb, $ahorro){
        if($ahorro){
            $qb->where($qb->expr()->like('ahorro.username', ':username'));
            $qb->setParameter('username', "%{$ahorro}%");
        }
    }
}
