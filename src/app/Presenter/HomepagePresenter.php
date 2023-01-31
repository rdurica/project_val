<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Component\Form\Login\ILoginForm;
use App\Component\Form\Login\LoginForm;
use Nette\Application\AbortException;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

/**
 * This presenter is only for login purposes
 */
final class HomepagePresenter extends Presenter
{
    #[Inject]
    public ILoginForm $loginForm;

    /**
     * If user is already logged in redirect him to projects view
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
     */
    protected function createComponentLoginForm(): LoginForm
    {
        return $this->loginForm->create();
    }
}
