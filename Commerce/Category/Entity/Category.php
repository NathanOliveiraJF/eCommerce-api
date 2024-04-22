<?php

namespace Commerce\Category\Entity;

use Commerce\Category\DTO\CategoryRequestDTO;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'categories')]
class Category
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(type: 'string', unique: true)]
    private string $code;
    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'datetime', generated: 'INSERT')]
    private DateTime $created_at;

    #[ORM\Column(type: 'datetime', generated: 'INSERT')]
    private DateTime $updated_at;

    public function __construct(int $id, string $code, string $name)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @param CategoryRequestDTO $categoryRequestDTO
     * @return void
     */
    public function populateFromDTO(CategoryRequestDTO $categoryRequestDTO): void
    {
        self::setName($categoryRequestDTO->name);
        self::setCode($categoryRequestDTO->code);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}