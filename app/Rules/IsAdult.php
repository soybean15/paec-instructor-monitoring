<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Illuminate\Support\Carbon;
class IsAdult implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $birthday = Carbon::parse($value);

        if (!$birthday || !$birthday->isValid()) {
            $fail("The $attribute is not a valid date.");
            return;
        }
    
    
        $age = $birthday->diffInYears(Carbon::now());
    
       
        if ($age < 18) {
            $fail("User must be at least 18 years old");
            return;
        }
    }
  
}