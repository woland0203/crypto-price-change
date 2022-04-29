<?php

namespace App\Services\Validator\Rules;

class RequiredRule implements Rule
{
    public function validate($attributeValue = null, string $attributeName = ''): bool
    {
        return (boolean)$attributeValue;
    }

    public function message($attributeValue = null, string $attributeName = ''): string
    {
        return sprintf('Attribute "%s" property', $attributeName);
    }
}
