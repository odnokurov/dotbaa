<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumericValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не число';

    public function rule(): bool
    {
        $pattern = '/^\d+$/';
        return (bool)preg_match($pattern, (string)$this->value);
    }
}