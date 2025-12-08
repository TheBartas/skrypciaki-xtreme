<?php

namespace App\Entity;

use App\Repository\ItemRepository;
<<<<<<< HEAD
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
=======
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\Table(name: "Item")]
>>>>>>> 88f5649 (km2)
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
<<<<<<< HEAD
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 128)]
    private ?string $director = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $actors = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(nullable: true)]
    private ?int $season = null;

    /**
     * @var Collection<int, Streaming>
     */
    #[ORM\ManyToMany(targetEntity: Streaming::class, inversedBy: 'items')]
    private Collection $streamings;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'items')]
    private Collection $tags;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'items')]
    private Collection $categories;

    /**
     * @var Collection<int, Rating>
     */
    #[ORM\ManyToMany(targetEntity: Rating::class, inversedBy: 'items')]
    private Collection $ratings;

    public function __construct()
    {
        $this->streamings = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->ratings = new ArrayCollection();
    }

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): static
    {
        $this->director = $director;

        return $this;
    }

    public function getActors(): ?string
    {
        return $this->actors;
    }

    public function setActors(string $actors): static
    {
        $this->actors = $actors;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(?int $season): static
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @return Collection<int, Streaming>
     */
    public function getStreamings(): Collection
    {
        return $this->streamings;
    }

    public function addStreaming(Streaming $streaming): static
    {
        if (!$this->streamings->contains($streaming)) {
            $this->streamings->add($streaming);
        }

        return $this;
    }

    public function removeStreaming(Streaming $streaming): static
    {
        $this->streamings->removeElement($streaming);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): static
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
        }

        return $this;
    }

    public function removeRating(Rating $rating): static
    {
        $this->ratings->removeElement($rating);

        return $this;
    }
=======
    #[ORM\Column(type: "integer", name: "item_ID")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, name: "name")]
    private string $name;

    #[ORM\Column(type: "integer", name: "year")]
    private int $year;

    #[ORM\Column(type: "string", length: 255, name: "director")]
    private string $director;

    #[ORM\Column(type: "text", name: "actors")]
    private string $actors;

    #[ORM\Column(type: "integer", name: "type")]
    private int $type;

    #[ORM\Column(type: "integer", nullable: true, name: "duration")]
    private ?int $duration = null;

    #[ORM\Column(type: "integer", nullable: true, name: "season")]
    private ?int $season = null;

    public function getId(): ?int { return $this->id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getYear(): int { return $this->year; }
    public function setYear(int $year): self { $this->year = $year; return $this; }

    public function getDirector(): string { return $this->director; }
    public function setDirector(string $director): self { $this->director = $director; return $this; }

    public function getActors(): string { return $this->actors; }
    public function setActors(string $actors): self { $this->actors = $actors; return $this; }

    public function getType(): int { return $this->type; }
    public function setType(int $type): self { $this->type = $type; return $this; }

    public function getDuration(): ?int { return $this->duration; }
    public function setDuration(?int $duration): self { $this->duration = $duration; return $this; }

    public function getSeason(): ?int { return $this->season; }
    public function setSeason(?int $season): self { $this->season = $season; return $this; }
>>>>>>> 88f5649 (km2)
}
