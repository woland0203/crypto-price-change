<?php

namespace App\Services\ValidatorAssets;

use App\Services\Validator\Rules\NumericRule;
use App\Services\Validator\Rules\RequiredRule;
use App\Services\Validator\Rules\StringRule;
use App\Services\Validator\RulesAsset;

class CryptoDataRulesAsset implements RulesAsset
{
    public function getRules(): array
    {
        return [
            'name' => [new RequiredRule(), new StringRule()],
            'availableQuantity' => [new RequiredRule(), new NumericRule()],
            'price' => [new RequiredRule(), new NumericRule()],
        ];
    }
}
