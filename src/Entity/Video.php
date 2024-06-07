<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    #[Assert\Type('string')]
    private ?string $videoHost = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    #[Assert\Type('string')]
    private ?string $videoId = null;

    #[ORM\Column(length: 1024)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(max: 1024)]
    #[Assert\Type('string')]
    private ?string $embedUrl = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?Tricks $tricks = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoHost(): ?string
    {
        return $this->videoHost;
    }

    public function setVideoHost(string $videoHost): static
    {
        $this->videoHost = $videoHost;

        return $this;
    }

    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    public function setVideoId(string $videoId): static
    {
        $this->videoId = $videoId;

        return $this;
    }

    public function getEmbedUrl(): ?string
    {
        return $this->embedUrl;
    }

    public function setEmbedUrl(string $embedUrl): static
    {
        $this->embedUrl = $embedUrl;

        return $this;
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
}
