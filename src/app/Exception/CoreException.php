<?php
declare(strict_types=1);

namespace App\Exception;

class CoreException extends \Exception
{
    protected $message = "Oops, Something went wrong!";
}