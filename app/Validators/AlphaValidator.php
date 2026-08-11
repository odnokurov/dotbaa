<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class AlphaValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать только буквы';

    public function rule(): bool
    {
        $pattern = '/^[\p{L}]+$/u';
        return (bool)preg_match($pattern, (string)$this->value);
    }
}