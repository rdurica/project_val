<?php

declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @property-read ?int $id
 */
#[ORM\Entity]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 150, unique: true)]
    public string $title;

    #[ORM\Column(type: "text")]
    public string $description;

    #[ORM\Column(type: "integer", nullable: true)]
    public ?int $expectedCost;

    #[ORM\Column(type: "date", nullable: true)]
    public ?DateTime $projectStartDate;

    #[ORM\Column(type: "date", nullable: true)]
    public ?DateTime $projectEndDate;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "created_by", referencedColumnName: "id")]
    public User $createdBy;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP",])]
    public readonly DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function __get(string $name)
    {
        if ($name === "id") {
            return $this->id;
        }
    }
}
