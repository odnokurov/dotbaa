<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть корректной датой (ГГГГ-ММ-ДД)';

    public function rule(): bool
    {
        $pattern = '/^\d{4}-\d{2}-\d{2}$/';
        if (!preg_match($pattern, (string)$this->value)) {
            return false;
        }
        $date = \DateTime::createFromFormat('Y-m-d', (string)$this->value);
        return $date && $date->format('Y-m-d') === (string)$this->value;
    }
}