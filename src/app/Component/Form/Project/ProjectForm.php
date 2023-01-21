<?php

declare(strict_types=1);

namespace App\Component\Form\Project;

use App\Component\AbstractComponent;
use JetBrains\PhpStorm\NoReturn;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class ProjectForm extends AbstractComponent
{


    public function createComponentProjectForm(): Form
    {
        //Todo: Add fields, needs to thing about logic and purpose. What wil be calculated and which fields are needed.Also connect to RabbitMQ and calculate something
        $form = new Form();
        $form->addText("title", "title")
            ->setRequired()
            ->setHtmlAttribute("class", "form-control");
        $form->addText("description", "description")
            ->setRequired()
            ->setHtmlAttribute("class", "form-control");
        $form->addInteger("expectedCost", "expectedCost")
            ->setRequired()
            ->setHtmlAttribute("class", "form-control");
        $form->addText("projectStartDate", "projectStartDate")
            ->setRequired()
            ->setHtmlAttribute("class", "form-control");
        $form->addText("projectEndDate", "projectEndDate")
            ->setRequired()
            ->setHtmlAttribute("class", "form-control");
        $form->addSubmit("save", "Save")
            ->setHtmlAttribute("class", "btn btn-success");
        $form->onSuccess[] = [$this, "formSucceeded"];


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
        $this->getPresenter()->redirect("Projects:");
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . "/default.latte");
        $this->getTemplate()->render();
    }

}