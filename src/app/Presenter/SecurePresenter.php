<?php

declare(strict_types=1);

namespace App\Presenter;

use JetBrains\PhpStorm\NoReturn;
use Nette\Application\AbortException;
use Nette\Application\UI\Presenter;

/**
 * All presenter which require some authentication needs to inherit from this
 */
abstract class SecurePresenter extends Presenter
{
    /**
     * Logout current user and clear identity.
     * @throws AbortException
     */
    #[NoReturn] protected function actionLogOut(): void
    {
        $this->getUser()->logout(true);
        $this->redirect("Homepage:");
    }

    /**
     * Ensure user is logged in
     * @throws AbortException
     */
    protected function startup(): void
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect("Homepage:");
        }
        $this->setLayout("layoutSecure");
    }
}
