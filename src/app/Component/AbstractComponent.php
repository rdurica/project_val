<?php
declare(strict_types=1);

namespace App\Component;

use Contributte\Translation\Translator;
use Nette\Application\UI\Control;


abstract class AbstractComponent extends Control
{
    protected Translator $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public abstract function render(): void;
}