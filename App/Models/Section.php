<?php

namespace App\Models;

class Section
{
    private string $name;
    private string $content;
    private ?int $id;
    private ?int $masterId = 999;

    public function __construct(
        string $name,
        string $content,
        ?int $id,
        ?int $masterId
    )
    {
        $this->name = $name;
        $this->content = $content;
        $this->id = $id;
        $this->masterId = $masterId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMasterId(): ?int
    {
        return $this->masterId;
    }

    public function setMasterId(?int $masterId): void
    {
        $this->masterId = $masterId;
    }
}