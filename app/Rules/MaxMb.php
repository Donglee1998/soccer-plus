<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxMb implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (mb_strlen($value, 'UTF-8') <= intval($this->parameters[0])) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
