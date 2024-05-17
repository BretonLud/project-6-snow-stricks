<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tricks>
 */
class TricksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tricks::class);
    }
    
    public function save(Tricks $tricks, bool $flush = false): void
    {
        $this->getEntityManager()->persist($tricks);
        
        if ($flush)
        {
            $this->getEntityManager()->flush();
        }
    }
    
    public function remove(Tricks $tricks, bool $flush = false): void
    {
        $this->getEntityManager()->remove($tricks);
        
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
