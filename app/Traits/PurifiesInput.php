<?php

/**
 * Makes use of FormRequest::prepareForValidation() to purify
 * chosen inputs with HTMLPurifier before(!) validation.
 *
 * @see SanitizesInput
 */

namespace App\Traits;

trait PurifiesInput
{
    protected function prepareForValidation()
    {
        $this->purify($this->purifiers());
    }

    protected function purify(array $purifiers): void
    {
        $inputs = $this->all();

        foreach ($purifiers as $input) {
            if ($data = data_get($inputs, $input)) {
                data_set($inputs, $input, \Purifier::clean($data));
            }
        }

        $this->replace($inputs);
    }

    protected function purifiers(): array
    {
        if (property_exists($this, 'purify')) {
            return $this->purify;
        }

        return []; // @codeCoverageIgnore
    }
}
