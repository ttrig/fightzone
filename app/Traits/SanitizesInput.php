<?php

/**
 * Makes use of FormRequest::prepareForValidation() to sanitize
 * chosen inputs before(!) validation.
 *
 * Should be used on all text/string inputs to prevent xss and stuff.
 *
 * @link  https://medium.com/@melihovv/how-to-sanitize-input-data-in-declarative-manner-in-laravel-e4486068f751
 */

namespace App\Traits;

trait SanitizesInput
{
    protected function prepareForValidation()
    {
        $this->sanitize($this->sanitizers());
    }

    protected function sanitize(array $sanitizers): void
    {
        $inputs = $this->all();
        foreach ($sanitizers as $input) {
            if ($data = data_get($inputs, $input)) {
                data_set($inputs, $input, filter_var($data, FILTER_SANITIZE_STRING));
            }
        }
        $this->replace($inputs);
    }

    protected function sanitizers(): array
    {
        if (property_exists($this, 'sanitize')) {
            return $this->sanitize;
        }
        return []; // @codeCoverageIgnore
    }
}
