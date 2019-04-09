<?php

namespace EventoBundle\Repository;

class EventoRepository extends \Doctrine\ORM\EntityRepository
{
    public function buscarPorAtributos($evento){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('evento')
                ->from($this->getEntityName(), 'evento');
        $this->addSearchParameters($qb, $evento);
        return $qb->getQuery()->getResult();
    }

    public function addSearchParameters($qb, $evento){
        if($evento){
            $qb->where($qb->expr()->like('evento.username', ':username'));
            $qb->setParameter('username', "%{$evento}%");
        }
    }
}
