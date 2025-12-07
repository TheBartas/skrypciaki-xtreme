<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ORM\Table(name: "Item")]
class Item implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "item_ID", type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'integer')]
    private ?int $year = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $director = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $actors = null;

    #[ORM\Column(type: 'integer')]
    private ?int $type = null;

    #[ORM\Column(type: 'integer')]
    private ?int $duration = null;
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $season = null;



//    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'items', cascade: ['persist'])]
//    private Collection $tags;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'items', cascade: ['persist'])]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: Streamings::class, inversedBy: 'items', cascade: ['persist'])]
    private Collection $streamings;

    public function __construct()
    {
//        $this->tags = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->streamings = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;
        return $this;
    }

    public function getActors(): ?string
    {
        return $this->actors;
    }
    public function setActors(string $actors): self
    {
        $this->actors = $actors; return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }
    public function setDuration(int $duration): self
    {
        $this->duration = $duration; return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }
    public function setSeason(?int $season): self
    {
        $this->season = $season; return $this;
    }


//    /** @return Collection<int, Tag> */
//    public function getTags(): Collection
//    {
//        return $this->tags;
//    }
//
//    public function addTag(Tag $tag): self
//    {
//        if (!$this->tags->contains($tag)) {
//            $this->tags->add($tag);
//        }
//        return $this;
//    }
//
//    public function removeTag(Tag $tag): self
//    {
//        $this->tags->removeElement($tag);
//        return $this;
//    }

    /** @return Collection<int, Categories> */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->categories->removeElement($category);
        return $this;
    }

    /** @return Collection<int, Streamings> */
    public function getStreamings(): Collection
    {
        return $this->streamings;
    }

    public function addStreaming(Streamings $streaming): self
    {
        if (!$this->streamings->contains($streaming)) {
            $this->streamings->add($streaming);
        }
        return $this;
    }

    public function removeStreaming(Streamings $streaming): self
    {
        $this->streamings->removeElement($streaming);
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'year' => $this->getYear(),
            'director' => $this->getDirector(),
            'actors' => $this->getActors(),
            'type' => $this->getType(),
            'duration' => $this->getDuration(),
            'season' => $this->getSeason(),
//            'categories' => $this->getCategories()->map(fn($c) => $c->getName())->toArray(),
//            'streamings' => $this->getStreamings()->map(fn($s) => $s->getName())->toArray(),
        ];
    }
}
