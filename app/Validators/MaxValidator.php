<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MaxValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть не больше :max';

    public function __construct(string $fieldName, $value, array $args = [], string $message = null)
    {
        parent::__construct($fieldName, $value, $args, $message);
        $this->messageKeys[':max'] = $this->args[0] ?? '';
    }

    public function rule(): bool
    {
        $pattern = '/^-?\d+$/';
        if (!preg_match($pattern, (string)$this->value)) {
            return false;
        }
        return (int)$this->value <= (int)($this->args[0] ?? PHP_INT_MAX);
    }
}