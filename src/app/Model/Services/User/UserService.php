<?php

declare(strict_types=1);

namespace App\Model\Services\User;

use App\Model\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

final class UserService implements Authenticator, AuthenticationInterface, AccountInterface
{
    public function __construct(
        private EntityManagerInterface $em,
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
        /** @var ?User $userEntity */
        $userEntity = $this->em->getRepository(User::class)->findOneBy(["username" => $user,]);
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

    /**
     * @param string $username
     * @param string $email
     * @param string $plainPassword
     * @return User
     */
    public function createAccount(string $username, string $email, string $plainPassword): User
    {
        $user = new User();
        $user->setEmail($email)
            ->setUsername($username)
            ->setPassword($this->passwords->hash($plainPassword));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function removeAccountById(int $id): void
    {
        // TODO: Implement removeAccountById() method.
    }

    public function resetPasswordById(int $id): void
    {
        // TODO: Implement resetPasswordById() method.
    }

    public function changePasswordById(int $id): void
    {
        // TODO: Implement changePasswordById() method.
    }
}
