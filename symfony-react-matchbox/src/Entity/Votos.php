<?php

namespace App\Entity;

use App\Repository\VotosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VotosRepository::class)
 */
class Votos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $__id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $positive;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $negative;
    //  Retornando o objeto inteiro
    public function getData() 
    {
        return [
            "__id" => $this -> getId(),
            "name" => $this -> getName(),
            "description" => $this -> getDescription(),
            "picture" => $this -> getPicture(),
            "positive" => $this -> getPositive(),
            "negative" => $this -> getNegative()
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $__id): self
    {
        $this->__id = $__id;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPositive(): ?int
    {
        return $this->positive;
    }

    public function setPositive(?int $positive): self
    {
        $this->positive = $positive;

        return $this;
    }

    public function getNegative(): ?int
    {
        return $this->negative;
    }

    public function setNegative(?int $negative): self
    {
        $this->negative = $negative;

        return $this;
    }
}
