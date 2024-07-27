<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

readonly class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    
    public function findAll(): array
    {
        return $this->userRepository->findAll();
    }
    
    public function remove(User $user): void
    {
        $this->userRepository->remove($user,true );
    }
}