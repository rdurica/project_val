<?php

declare(strict_types=1);

namespace App\Services\User;

use Nette\Security\SimpleIdentity;

interface AuthenticationInterface
{
    public function authenticate(string $user, string $password): SimpleIdentity;
}
