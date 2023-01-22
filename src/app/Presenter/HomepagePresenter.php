<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Login\ILoginForm;
use App\Component\Form\Login\LoginForm;
use Nette\Application\AbortException;
use Nette\DI\Attributes\Inject;

/**
 * This presenter is only for login purposes
 */
final class HomepagePresenter extends AbstractPresenter
{
    #[Inject]
    public ILoginForm $loginForm;

    /**
     * If user is already logged in redirect him to projects view
     * @return void
     * @throws AbortException
     */
    protected function startup(): void
    {
        parent::startup();
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect("Projects:");
        }
    }

    /**
     * Login form
     * @return LoginForm
     */
    protected function createComponentLoginForm(): LoginForm
    {
        return $this->loginForm->create();
    }
}
