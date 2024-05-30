<?php

namespace App\Repository;

use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Group>
 */
class GroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }
    public function save(Group $group, bool $flush = false): void
    {
        $this->getEntityManager()->persist($group);
        if ($flush)
        {
            $this->getEntityManager()->flush();
        }
    }
    
    public function remove(Group $group, bool $flush = false): void
    {
        $this->getEntityManager()->remove($group);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
