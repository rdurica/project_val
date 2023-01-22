<?php

declare(strict_types=1);

namespace App\Component;

use Contributte\Translation\Translator;
use Nette\Application\UI\Control;


abstract class AbstractComponent extends Control
{

    public function __construct(protected Translator $translator)
    {
    }

    abstract public function render(): void;
}