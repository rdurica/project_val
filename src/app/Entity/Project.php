<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 150, unique: true)]
    private string $title;

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(type: "integer", nullable: true)]
    private int $expectedCost;

    #[ORM\Column(type: "date", nullable: true)]
    private DateTime $projectStartDate;

    #[ORM\Column(type: "date", nullable: true)]
    private DateTime $projectEndDate;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "created_by", referencedColumnName: "id")]
    private User $createdBy;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP",])]
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Project
     */
    public function setTitle(string $title): Project
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Project
     */
    public function setDescription(string $description): Project
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpectedCost(): int
    {
        return $this->expectedCost;
    }

    /**
     * @param int $expectedCost
     * @return Project
     */
    public function setExpectedCost(int $expectedCost): Project
    {
        $this->expectedCost = $expectedCost;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getProjectStartDate(): DateTime
    {
        return $this->projectStartDate;
    }

    /**
     * @param DateTime $projectStartDate
     * @return Project
     */
    public function setProjectStartDate(DateTime $projectStartDate): Project
    {
        $this->projectStartDate = $projectStartDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getProjectEndDate(): DateTime
    {
        return $this->projectEndDate;
    }

    /**
     * @param DateTime $projectEndDate
     * @return Project
     */
    public function setProjectEndDate(DateTime $projectEndDate): Project
    {
        $this->projectEndDate = $projectEndDate;

        return $this;
    }

    /**
     * @return User
     */
    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }


    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

}