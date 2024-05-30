<?php

namespace App\Entity;

use App\Repository\TricksRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TricksRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['title'], message: 'Trick already exists.')]
class Tricks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 2500)]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    #[Assert\Type('string')]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    #[Assert\Type('string')]
    private ?string $summary = null;

    #[ORM\ManyToOne(inversedBy: 'tricks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'tricks')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private ?Group $category = null;

    #[ORM\Column(length: 255)]
    #[Assert\Type('string')]
    private ?string $slug = null;
    
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        $this->updateSlug();

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }
    
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setSummary(): static
    {
        if ($this->content) {
            $this->summary = substr($this->content, 0, 255);
        }
        
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCategory(): ?Group
    {
        return $this->category;
    }

    public function setCategory(?Group $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    public function updateSlug(): void
    {
        $slugger = new AsciiSlugger();
        $this->slug = $slugger->slug($this->title);
    }
    
    public function __toString(): string
    {
        return $this->title;
    }
    
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTimeImmutable());
    }
}
