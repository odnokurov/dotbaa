<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MinValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть не меньше :min';

    public function __construct(string $fieldName, $value, array $args = [], string $message = null)
    {
        parent::__construct($fieldName, $value, $args, $message);
        $this->messageKeys[':min'] = $this->args[0] ?? '';
    }

    public function rule(): bool
    {
        $pattern = '/^-?\d+$/';
        if (!preg_match($pattern, (string)$this->value)) {
            return false;
        }
        return (int)$this->value >= (int)($this->args[0] ?? 0);
    }
}