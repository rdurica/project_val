<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Entity\User;

interface AccountInterface
{
    public function createAccount(string $username, string $email, string $plainPassword): User;

    public function removeAccountById(int $id): void;

    public function resetPasswordById(int $id): void;

    public function changePasswordById(int $id): void;
}
