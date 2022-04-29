<?php

namespace App\Services\Validator\Rules;

class NumericRule implements Rule
{
    public function validate($attributeValue = null, string $attributeName = ''): bool
    {
        return is_numeric($attributeValue);
    }

    public function message($attributeValue = null, string $attributeName = ''): string
    {
        return sprintf('Attribute "%s" should be number', $attributeName);
    }
}
