<?php

namespace App\Entity;

use App\Repository\StreamingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StreamingsRepository::class)]
#[ORM\Table(name: "Streamings")]
class Streamings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", name: "streaming_ID")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, name: "platform_name")]
    private string $platformName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatformName(): string
    {
        return $this->platformName;
    }

    public function setPlatformName(string $platformName): self
    {
        $this->platformName = $platformName;
        return $this;
    }

}
