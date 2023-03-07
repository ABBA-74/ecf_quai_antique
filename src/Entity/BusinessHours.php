<?php

namespace App\Entity;

use App\Repository\BusinessHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusinessHoursRepository::class)]
class BusinessHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $openingHourLunch = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closingHourLunch = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $openingHourDiner = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closingHourDiner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningHourLunch(): ?\DateTimeInterface
    {
        return $this->openingHourLunch;
    }

    public function setOpeningHourLunch(\DateTimeInterface $openingHourLunch): self
    {
        $this->openingHourLunch = $openingHourLunch;

        return $this;
    }

    public function getClosingHourLunch(): ?\DateTimeInterface
    {
        return $this->closingHourLunch;
    }

    public function setClosingHourLunch(\DateTimeInterface $closingHourLunch): self
    {
        $this->closingHourLunch = $closingHourLunch;

        return $this;
    }

    public function getOpeningHourDiner(): ?\DateTimeInterface
    {
        return $this->openingHourDiner;
    }

    public function setOpeningHourDiner(\DateTimeInterface $openingHourDiner): self
    {
        $this->openingHourDiner = $openingHourDiner;

        return $this;
    }

    public function getClosingHourDiner(): ?\DateTimeInterface
    {
        return $this->closingHourDiner;
    }

    public function setClosingHourDiner(\DateTimeInterface $closingHourDiner): self
    {
        $this->closingHourDiner = $closingHourDiner;

        return $this;
    }
}
