<?php

namespace App\Service;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Exception;

readonly class TricksService
{
    public function __construct(private TricksRepository $tricksRepository)
    {
    }
    
    /**
     * @return Tricks[]
     */
    public function findAll(): array
    {
        return $this->tricksRepository->findAll();
    }
    
    
    /**
     * @param string $slug
     * @return Tricks
     */
    public function findOneBySlug(string $slug): Tricks
    {
        return $this->tricksRepository->findOneBy(['slug' => $slug]);
    }
    
    /**
     * @param Tricks $tricks
     * @throws Exception
     */
    public function save(Tricks $tricks): void
    {
        try {
            $this->tricksRepository->save($tricks, true);
        } catch (Exception $e) {
            
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
