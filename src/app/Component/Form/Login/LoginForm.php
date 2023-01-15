<?php
declare(strict_types=1);

namespace App\Component\Form\Login;

use App\Component\AbstractComponent;
use Contributte\Translation\Translator;
use Nette\Application\UI\Form;
use Nette\Security\User;

final class LoginForm extends AbstractComponent
{
    private User $user;

    public function __construct(Translator $translator, User $user)
    {
        parent::__construct($translator);
        $this->user = $user;
    }

    public function createComponentLoginForm(): Form
    {
        $form = new Form();

        $form->addText('email', $this->translator->trans('user.email'))
            ->addRule(\Nette\Forms\Form::EMAIL)
            ->setHtmlAttribute('class', 'form-control');
        $form->addPassword('password', $this->translator->trans('user.password'))
            ->setRequired()
            ->setHtmlAttribute('class', 'form-control');
        $form->addSubmit('send', $this->translator->trans('button.login'))
            ->setHtmlAttribute('class', 'btn btn-info');

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(Form $form, $values): void
    {
        //ToDo: Login
    }


    public function render(): void
    {
        $this->template->setFile(__DIR__ . '/default.latte');
        $this->template->render();
    }
}