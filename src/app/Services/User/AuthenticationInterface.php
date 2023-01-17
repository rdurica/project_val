<?php
declare(strict_types=1);

namespace App\Services\User;

use Nette\Security\IIdentity;

interface AuthenticationInterface
{
    public function authenticate(string $user, string $password): IIdentity;


}