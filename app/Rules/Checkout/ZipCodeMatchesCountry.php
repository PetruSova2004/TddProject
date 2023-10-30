<?php

namespace App\Rules\Checkout;

use App\Models\Country;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ZipCodeMatchesCountry implements ValidationRule
{

    protected $country;
    public function __construct($country)
    {
        $this->country = Country::query()->where('name', $country)->first();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->country) {
            // This method receives the attribute name, its value, and a callback that should be invoked on failure with the validation error message:
            if ($value != $this->country->zip) {
                $fail("Zip " . $value . " doesnt match the " . $this->country->zip);
            }
        } else {
            $fail('Something is wrong with given country');
        }
    }
}
