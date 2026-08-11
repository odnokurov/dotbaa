<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MaxLengthValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не должно превышать :max символов';

    public function __construct(string $fieldName, $value, array $args = [], string $message = null)
    {
        parent::__construct($fieldName, $value, $args, $message);
        $this->messageKeys[':max'] = $this->args[0] ?? '';
    }

    public function rule(): bool
    {
        $pattern = '/(.)/u';
        $count = preg_match_all($pattern, (string)$this->value);
        return $count <= (int)($this->args[0] ?? PHP_INT_MAX);
    }
}