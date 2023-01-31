<?php

declare(strict_types=1);

namespace App\Exception\Model\Manager;

use App\Exception\Model\Entity\Project;
use Doctrine\ORM\EntityRepository;

class ProjectManager extends Manager
{
    public function getRepository(): EntityRepository
    {
        return $this->em->getRepository(Project::class);
    }
}
