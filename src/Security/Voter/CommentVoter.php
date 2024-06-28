<?php

namespace App\Security\Voter;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{
    const EDIT = 'COMMENT_ACCESS';
    
    public function __construct(private readonly Security $security)
    {
    }
    
    protected function supports(string $attribute,mixed $subject): bool
    {
        return $attribute == self::EDIT
            && $subject instanceof Comment;
    }
    
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        
        if (!$user instanceof User) {
            return false;
        }
        
        return $subject->getUser() == $user || $this->security->isGranted('ROLE_ADMIN');
      
    }
}
