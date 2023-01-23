<?php

declare(strict_types=1);

namespace App\Model\Manager;

use App\Model\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nette\Security\Passwords;

class UserManager extends AbstractManager
{
    public function __construct(
        protected EntityManagerInterface $em,
        private readonly Passwords $passwords
    ) {
        parent::__construct($em);
    }

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


    public function getUserByUsername(string $username): ?User
    {
        return $this->getRepository()->findOneBy(["username" => $username,]);
    }

    protected function getRepository(): EntityRepository
    {
        return $this->em->getRepository(User::class);
    }
}
