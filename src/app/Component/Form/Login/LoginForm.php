<?php

declare(strict_types=1);

namespace App\Component\Form\Login;

use App\Component\AbstractComponent;
use App\Services\User\AuthenticationInterface;
use Contributte\Translation\Translator;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\SimpleIdentity;
use Nette\Security\User;
use Nette\Utils\ArrayHash;

final class LoginForm extends AbstractComponent
{

    private User $user;
    private AuthenticationInterface $authentication;

    public function __construct(Translator $translator, AuthenticationInterface $authentication, User $user)
    {
        parent::__construct($translator);
        $this->user = $user;
        $this->translator = $translator;
        $this->authentication = $authentication;
    }

    public function createComponentLoginForm(): Form
    {
        $form = new Form();
        $form->addText('username', $this->translator->trans('user.username'))
            ->setRequired()
            ->setHtmlAttribute('class', 'form-control');
        $form->addPassword('password', $this->translator->trans('user.password'))
            ->setRequired()
            ->setHtmlAttribute('class', 'form-control');
        $form->addSubmit('send', $this->translator->trans('button.login'))
            ->setHtmlAttribute('class', 'btn btn-info');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    /**
     * @param Form $form
     * @param ArrayHash $values
     * @return void
     * @throws AbortException
     */
    public function formSucceeded(Form $form, ArrayHash $values): void
    {
        try {
            /** @var SimpleIdentity $userIdentity */
            $userIdentity = $this->authentication->authenticate($values->username, $values->password);
            $this->user->login($userIdentity);
            $this->presenter->flashMessage($this->translator->trans("messages.successfullyLoggedIn"), "success");
        } catch (AuthenticationException $authenticationException) {
            $this->presenter->flashMessage($this->translator->trans("messages.incorrectUsernameOrPassword"), "danger");
        }
        $this->redirect("this");
    }


    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . '/default.latte');
        $this->getTemplate()->render();
    }
}