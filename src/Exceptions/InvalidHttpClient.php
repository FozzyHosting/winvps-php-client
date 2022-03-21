<?php

namespace Fozzy\WinVPS\Api\Exceptions;

use Exception;

class InvalidHttpClient extends Exception
{
    protected $message = 'Class for the specified HTTP Client does not exist';
}
