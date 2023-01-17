<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

final class UserService implements Authenticator, AuthenticationInterface, AccountInterface
{

    private EntityManagerInterface $em;
    private Passwords $passwords;

    /**
     * @param EntityManagerInterface $em
     * @param Passwords $passwords
     */
    public function __construct(EntityManagerInterface $em, Passwords $passwords)
    {
        $this->em = $em;
        $this->passwords = $passwords;
    }

    /**
     * @param string $user username
     * @param string $password
     * @return IIdentity
     * @throws AuthenticationException
     */
    public function authenticate(string $user, string $password): IIdentity
    {
        /** @var ?User $userEntity */
        $userEntity = $this->em->getRepository("App\\Entity\\User")->findOneBy(["username" => $user,]);

        if (!$userEntity){
            throw new AuthenticationException("User not found");
        }
        if ($userEntity->getPassword() !== $this->getPasswordHash($password)){
            throw new AuthenticationException("Incorrect Password");
        }

        return new SimpleIdentity($userEntity->getId(), roles: [], data: [
            "email" => $userEntity->getEmail(),
        ]);
    }

    private function getPasswordHash(string $plainPassword): string
    {
        return $this->passwords->hash($plainPassword);
    }

    public function createAccount(string $username, string $email, string $plainPassword): User
    {
        // TODO: Implement add() method.
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