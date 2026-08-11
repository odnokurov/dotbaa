<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MinLengthValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать минимум :min символов';

    public function __construct(string $fieldName, $value, array $args = [], string $message = null)
    {
        parent::__construct($fieldName, $value, $args, $message);
        $this->messageKeys[':min'] = $this->args[0] ?? '';
    }

    public function rule(): bool
    {
        $pattern = '/(.)/u';
        $count = preg_match_all($pattern, (string)$this->value);
        return $count >= (int)($this->args[0] ?? 0);
    }
}