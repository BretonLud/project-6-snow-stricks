<?php

namespace App\Service;

use App\Entity\Group;
use App\Repository\GroupRepository;

readonly class GroupService
{
    public function __construct(private GroupRepository $groupRepository)
    {
    }
    
    /**
     * @return Group[]
     */
    public function getGroups(): array
    {
        return $this->groupRepository->findAll();
    }
    
    public function save(Group $group, true $true): void
    {
        $this->groupRepository->save($group, $true);
    }
    
    public function remove(Group $group, true $true)
    {
        $this->groupRepository->remove($group, $true);
    }
}