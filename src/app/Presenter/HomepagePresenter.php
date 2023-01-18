<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Login\ILoginForm;
use App\Component\Form\Login\LoginForm;
use Nette\DI\Attributes\Inject;

final class HomepagePresenter extends AbstractPresenter
{
    #[Inject]
    public ILoginForm $loginForm;

    public function handleLogOut(): void
    {
        $this->getUser()->logout(true);
    }

    protected function createComponentLoginForm(): LoginForm
    {
        return $this->loginForm->create();
    }
}
