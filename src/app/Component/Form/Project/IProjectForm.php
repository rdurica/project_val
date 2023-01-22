<?php

declare(strict_types=1);

namespace App\Component\Form\Project;

interface IProjectForm
{
    public function create(): ProjectForm;
}
