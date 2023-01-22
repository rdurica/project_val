<?php

declare(strict_types=1);

namespace App\Exception;

class AccountExistsException extends CoreException
{
    protected $message = "Account already exists";
}
