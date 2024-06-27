<?php

namespace App\Entity\Trait;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait DateTrait
{
    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private ?DateTimeImmutable $createdAt;
    
    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt;
    
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
    
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTimeImmutable());
    }
}