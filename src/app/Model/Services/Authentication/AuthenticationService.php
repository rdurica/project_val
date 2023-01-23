<?php

declare(strict_types=1);

namespace App\Model\Services\Authentication;

use App\Model\Manager\UserManager;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

final class AuthenticationService implements Authenticator, AuthenticationInterface
{
    public function __construct(
        private UserManager $userManager,
        private Passwords $passwords
    ) {
    }


    /**
     * @param string $user username
     * @param string $password
     * @return SimpleIdentity
     * @throws AuthenticationException
     */
    public function authenticate(string $user, string $password): SimpleIdentity
    {
        $userEntity = $this->userManager->getUserByUsername($user);
        if (!$userEntity) {
            throw new AuthenticationException("User not found");
        }

        if (!$this->passwords->verify($password, $userEntity->getPassword())) {
            throw new AuthenticationException("Incorrect Password");
        }

        return new SimpleIdentity($userEntity->getId(), roles: [], data: [
            "username" => $userEntity->getUsername(),
            "email" => $userEntity->getEmail(),
        ]);
    }
}
