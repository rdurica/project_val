<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Login\ILoginForm;
use App\Component\Form\Login\LoginForm;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;
use Nette\Security\User;

final class HomepagePresenter extends Presenter
{
    #[Inject]
    public ILoginForm $loginForm;

    #[Inject]
    public User $user;

    public function handleLogOut(): void
    {
        $this->user->logout(true);
    }

    protected function createComponentLoginForm(): LoginForm
    {
        return $this->loginForm->create();
    }
}
