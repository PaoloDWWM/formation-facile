<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TutoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TutoRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'tuto:item']),
        new GetCollection(normalizationContext: ['groups' => 'tuto:list'])
    ],
    order: ['name' => 'ASC'],
    paginationEnabled: false,
)]
class Tuto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $subtitle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $video = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tuto:list', 'tuto:item'])]
    private ?string $link = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }
}
