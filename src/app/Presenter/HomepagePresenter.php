<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Login\ILoginForm;
use App\Component\Form\Login\LoginForm;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

final class HomepagePresenter extends Presenter
{
    #[Inject]
    public ILoginForm $loginForm;

    protected function createComponentLoginForm(): LoginForm
    {
        return $this->loginForm->create();
    }
}
