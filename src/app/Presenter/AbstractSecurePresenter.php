<?php

declare(strict_types=1);

namespace App\Presenter;

use JetBrains\PhpStorm\NoReturn;

/**
 * All presenter which require some authentication needs to inherit from this
 */
abstract class AbstractSecurePresenter extends AbstractPresenter
{
    /**
     * Logout current user and clear identity.
     *
     * @return void
     * @throws \Nette\Application\AbortException
     */
    #[NoReturn] public function actionLogOut(): void
    {
        $this->getUser()->logout(true);
        $this->redirect("Homepage:");
    }

    /**
     * Ensure user is logged in
     *
     * @return void
     * @throws \Nette\Application\AbortException
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
