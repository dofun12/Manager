<?php

namespace Acme\ManagerBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{
    public function findBetween($from, $to) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb->select('t')
            ->from('AcmeManagerBundle:Task', 't')
            ->where($qb->expr()->between('t.start', ':from', ':to'))
            ->setParameters(array(
                'from' => $from->format("Y-m-d H:i:s"),
                'to'   => $to->format("Y-m-d H:i:s"),
            ))
            ->getQuery()->getResult();
    }

    public function findUnscheduled() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb->select('t')
            ->from('AcmeManagerBundle:Task', 't')
            ->where('t.start is NULL')
            ->getQuery()->getResult();
    }
}