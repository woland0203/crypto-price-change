<?php

namespace App\Services\ValidatorAssets;

use App\Services\Validator\Rules\NumericRule;
use App\Services\Validator\Rules\StringRule;
use App\Services\Validator\RulesAsset;

class CryptoDataUpdateRulesAsset implements RulesAsset
{
    public function getRules(): array
    {
        return [
            'name' => [new StringRule()],
            'availableQuantity' => [new NumericRule()],
            'price' => [new NumericRule()],
        ];
    }
}
