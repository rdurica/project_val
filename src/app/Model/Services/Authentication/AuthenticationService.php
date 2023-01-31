<?php

declare(strict_types=1);

namespace App\Model\Services\Authentication;

use App\Model\Manager\UserManager;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

final readonly class AuthenticationService implements Authenticator
{
    public function __construct(
        private UserManager $userManager,
        private Passwords $passwords
    ) {
    }


    /**
     * @throws AuthenticationException
     */
    public function authenticate(string $user, string $password): SimpleIdentity
    {
        $userEntity = $this->userManager->getUserByUsername($user);
        if (!$userEntity) {
            throw new AuthenticationException("User not found");
        }

        if (!$this->passwords->verify($password, $userEntity->password)) {
            throw new AuthenticationException("Incorrect Password");
        }

        if (!$userEntity->isEnabled) {
            throw new AuthenticationException("Account is disabled");
        }

        return new SimpleIdentity($userEntity->id, roles: [], data: [
            "username" => $userEntity->username,
            "email" => $userEntity->email,
        ]);
    }
}
