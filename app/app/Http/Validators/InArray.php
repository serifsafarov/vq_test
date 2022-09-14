<?php
namespace App\Http\Validators;

use Attribute;
use Spatie\DataTransferObject\Validation\ValidationResult;
use Spatie\DataTransferObject\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class InArray implements Validator
{
    public function __construct(
        private array $allowedValues
    ) {
    }

    public function validate(mixed $value): ValidationResult
    {
        return in_array(
            $value,
            $this->allowedValues
        ) ? ValidationResult::valid() : ValidationResult::invalid("Value should be in list (" . collect($this->allowedValues)->implode(', ') . ")");
    }
}
