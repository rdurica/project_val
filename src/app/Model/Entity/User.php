<?php

declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 30, unique: true)]
    private string $username;

    #[ORM\Column(type: "string", length: 30, unique: true)]
    private string $email;

    #[ORM\Column(type: "string", length: 150)]
    private string $password;

    #[ORM\Column(type: "boolean", options: ["default" => true])]
    private bool $isEnabled;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP",])]
    private DateTime $registrationDate;

    public function __construct()
    {
        $this->isEnabled = true;
        $this->registrationDate = new DateTime();
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param  string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param  string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param  bool $isEnabled
     * @return User
     */
    public function setIsEnabled(bool $isEnabled): User
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }
}
