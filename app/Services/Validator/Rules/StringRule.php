<?php

namespace App\Services\Validator\Rules;

class StringRule implements Rule
{
    public function validate($attributeValue = null, string $attributeName = ''): bool
    {
        if ($attributeValue === null) {
            return true;
        }

        return is_string($attributeValue);
    }

    public function message($attributeValue = null, string $attributeName = ''): string
    {
        return sprintf('Attribute "%s" should be string', $attributeName);
    }
}
