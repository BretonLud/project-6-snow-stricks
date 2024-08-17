<?php
    
    namespace App\Repository;
    
    use App\Entity\Comment;
    use App\Entity\Tricks;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\ORM\Tools\Pagination\Paginator;
    use Doctrine\Persistence\ManagerRegistry;
    
    /**
     * @extends ServiceEntityRepository<Comment>
     */
    class CommentRepository extends ServiceEntityRepository
    {
        public function __construct(ManagerRegistry $registry)
        {
            parent::__construct($registry, Comment::class);
        }
        
        public function save(Comment $comment, bool $flush = false): void
        {
            $this->getEntityManager()->persist($comment);
            
            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
        
        public function remove(Comment $comment, bool $flush = false): void
        {
            $this->getEntityManager()->remove($comment);
            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
        
        public function getCommentsPaginated(Tricks $trick, int $page): array
        {
            $result = [];
            
            $query = $this->createQueryBuilder('c')
                ->andWhere('c.tricks = :trick')
                ->setParameter('trick', $trick)
                ->orderBy('c.createdAt', 'DESC')
                ->setFirstResult(($page - 1) * 10)
                ->setMaxResults(10)
                ->getQuery();
            
            $paginator = new Paginator($query);
            $pages = 1;
            
            if ($paginator->count() > 0) {
                $pages = ceil($paginator->count() / 10);
                
                if ($page > $pages) {
                    $query->setFirstResult(($pages - 1) * 10);
                    $page = $pages;
                }
            }
            
            $data = $paginator->getQuery()->getResult();
            
            if (empty($data)) {
                return $result;
            }
            
            $result['pages'] = $pages;
            $result['comments'] = $data;
            $result['page'] = $page;
            
            return $result;
        }
    }
