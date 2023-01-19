<?php

declare(strict_types=1);

namespace App\Presenter;

use Nette\DI\Attributes\Inject;
use App\Component\Grid\Project\IProjectGrid;
use App\Component\Grid\Project\ProjectGrid;

final class ProjectsPresenter extends AbstractSecurePresenter
{
    #[Inject]
    public IProjectGrid $projectGrid;

    public function createComponentProjectGrid(): ProjectGrid
    {
        return $this->projectGrid->create();
    }

    public function renderDetail(int $id)
    {
    }
}