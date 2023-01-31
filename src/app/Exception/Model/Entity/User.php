<?php

declare(strict_types=1);

namespace App\Exception\Model\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @property-read ?int $id
 */
#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\Column(type: "string", length: 30, unique: true)]
    public string $username;

    #[ORM\Column(type: "string", length: 30, unique: true)]
    public string $email;

    #[ORM\Column(type: "string", length: 150)]
    public string $password;

    #[ORM\Column(type: "boolean", options: ["default" => true])]
    public bool $isEnabled;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP",])]
    public DateTime $registrationDate;

    public function __construct()
    {
        $this->isEnabled = true;
        $this->registrationDate = new DateTime();
    }

    public function __get(string $name)
    {
        if ($name === "id") {
            return $this->id;
        }
    }
}
