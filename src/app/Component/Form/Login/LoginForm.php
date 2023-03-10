<?php

declare(strict_types=1);

namespace App\Component\Form\Login;

use App\Component\Component;
use App\Model\Services\Authentication\AuthenticationService;
use Contributte\Translation\Translator;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Nette\Utils\ArrayHash;

final class LoginForm extends Component
{
    public function __construct(
        protected Translator $translator,
        private readonly AuthenticationService $authentication,
        private readonly User $user
    ) {
        parent::__construct($translator);
    }

    public function createComponentLoginForm(): Form
    {
        $form = new Form();
        $form->addText("username", $this->translator->trans("user.username"))
            ->setRequired()
            ->setHtmlAttribute("class", "form-control")
            ->setHtmlAttribute("id", "floatingInput");
        $form->addPassword("password", $this->translator->trans("user.password"))
            ->setRequired()
            ->setHtmlAttribute("class", "form-control");
        $form->addSubmit("login", $this->translator->trans("button.login"))
            ->setHtmlAttribute("class", "w-100 btn btn-lg btn-primary");

        $form->onSuccess[] = [$this, "formSucceeded"];

        return $form;
    }

    /**
     * @throws AbortException
     */
    public function formSucceeded(Form $form, ArrayHash $values): void
    {
        try {
            $userIdentity = $this->authentication->authenticate($values->username, $values->password);
            $this->user->login($userIdentity);
            $this->presenter->flashMessage($this->translator->trans("messages.successfullyLoggedIn"), "success");
            $this->presenter->redirect("Projects:");
        } catch (AuthenticationException $authenticationException) {
            $this->presenter->flashMessage($this->translator->trans("messages.incorrectUsernameOrPassword"), "danger");
            $this->presenter->redirect("this");
        }
    }


    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . "/default.latte");
        $this->getTemplate()->render();
    }
}
