<?php

namespace App\Services\Validator\Rules;

interface Rule
{
    public function validate($attributeValue = null, string $attributeName = ''): bool;

    public function message($attributeValue = null, string $attributeName = ''): string;
}

