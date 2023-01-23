<?php

declare(strict_types=1);

namespace App\Model\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class AbstractManager
{
    public function __construct(protected EntityManagerInterface $em)
    {
    }


    abstract protected function getRepository(): EntityRepository;
}
