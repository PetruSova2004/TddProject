<?php

namespace App\Rules\Checkout;

use App\Models\Country;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CountryShouldBeFromDB implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $country = Country::query()->where('name', $value)->first();
        if (!$country) {
            $fail('There are no such countries');
        }
    }
}
