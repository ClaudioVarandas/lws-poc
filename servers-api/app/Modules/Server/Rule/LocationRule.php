<?php

namespace App\Modules\Server\Rule;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Storage;

class LocationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $locationsDb = Storage::disk('db')->get('locations.json');

        $exists = false;

        foreach (json_decode($locationsDb,true) as $key => $item) {
            if($value === $item['value']){
                $exists = true;
            }
        }

        if($exists === false){
            $fail('The :attribute value is invalid.');
        }

    }
}
