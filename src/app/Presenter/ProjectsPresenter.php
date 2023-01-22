<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Project\IProjectForm;
use App\Component\Form\Project\ProjectForm;
use Nette\DI\Attributes\Inject;
use App\Component\Grid\Project\IProjectGrid;
use App\Component\Grid\Project\ProjectGrid;

final class ProjectsPresenter extends AbstractSecurePresenter
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
