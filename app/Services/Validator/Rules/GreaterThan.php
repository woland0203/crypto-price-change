<?php

namespace App\Services\Validator\Rules;

class GreaterThan implements Rule
{
    private int $greaterThan;

    public function __construct(int $greaterThan)
    {
        $this->greaterThan = $greaterThan;
    }

    public function validate($attributeValue = null, string $attributeName = ''): bool
    {
        if ($attributeValue === null) {
            return true;
        }

        return is_numeric($attributeValue) && $attributeValue > $this->greaterThan;
    }

    public function message($attributeValue = null, string $attributeName = ''): string
    {
        return sprintf('%F less than %F', $attributeValue, $this->greaterThan);
    }
}
