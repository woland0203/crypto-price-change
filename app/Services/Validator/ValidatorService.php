<?php

namespace App\Services\Validator;

use App\Services\Validator\Rules\Rule;

class ValidatorService
{
    public function validate(array $rulesAsset, array $data): array
    {
        $errors = [];
        foreach ($rulesAsset as $attributeName => $rules) {
            $value = $data[$attributeName] ?? null;
            /** @var Rule[] $rules */
            foreach ($rules as $rule) {
                if (!$rule->validate($value, $attributeName)) {
                    $errors[$attributeName] = $rule->message($value, $attributeName);
                }
            }
        }

        return $errors;
    }
}
