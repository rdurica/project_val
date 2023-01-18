<?php

declare(strict_types=1);

namespace App\Presenter;

abstract class AbstractSecurePresenter extends AbstractPresenter
{
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect("Homepage:");
        }
    }
}