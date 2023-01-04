<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Extension implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(public string $extension)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $value->getMimeType() !== $this->extension;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute extension must not be .php';
    }
}
