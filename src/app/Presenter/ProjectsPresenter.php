<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Project\IProjectForm;
use App\Component\Form\Project\ProjectForm;
use App\Component\Grid\Project\IProjectGrid;
use App\Component\Grid\Project\ProjectGrid;
use Nette\DI\Attributes\Inject;

final class ProjectsPresenter extends SecurePresenter
{
    #[Inject]
    public IProjectGrid $projectGrid;

    #[Inject]
    public IProjectForm $projectForm;

    protected function createComponentProjectGrid(): ProjectGrid
    {
        return $this->projectGrid->create();
    }

    protected function createComponentProjectForm(): ProjectForm
    {
        return $this->projectForm->create();
    }

    public function renderDetail(int $id)
    {
    }
}
