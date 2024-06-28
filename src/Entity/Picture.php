<?php

namespace App\Entity;

use App\Entity\Trait\DateTrait;
use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['filename'], message: 'Picture already exists.')]
class Picture
{
    use DateTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?Tricks $tricks = null;

    #[ORM\Column(length: 100)]
    private ?string $filename = null;
    
    private ?UploadedFile $file = null;

    #[ORM\Column]
    private ?bool $header = false;
    
    private string $index;
    
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTricks(): ?Tricks
    {
        return $this->tricks;
    }

    public function setTricks(?Tricks $tricks): static
    {
        $this->tricks = $tricks;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }
    
    public function setFile(?UploadedFile $file = null): void
    {
        $this->file = $file;
    }
    
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }
    
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTimeImmutable());
    }

    public function isHeader(): ?bool
    {
        return $this->header;
    }

    public function setHeader(bool $header): static
    {
        $this->header = $header;

        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getIndex(): ?string
    {
        return $this->index;
    }
    
    /**
     * @param string $index
     */
    public function setIndex(string $index): void
    {
        $this->index = $index;
    }
}
