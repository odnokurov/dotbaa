<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть корректным email-адресом';

    public function rule(): bool
    {
        $pattern = '/^[\w.+-]+@[\w-]+(\.[\w-]+)+$/';
        return (bool)preg_match($pattern, (string)$this->value);
    }
}