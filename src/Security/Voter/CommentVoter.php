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
    
    protected function supports($attribute, $subject): bool
    {
        return $attribute == self::EDIT
            && $subject instanceof Comment;
    }
    
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        if ($attribute == self::EDIT) {
            $user = $token->getUser();
            if (!$user instanceof User) {
                return false;
            }
            
            return $subject->getUser() == $user || $this->security->isGranted('ROLE_ADMIN');
        }
        
        return false;
    }
}