<?php

namespace Tests;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class TranslationTest extends TestCase
{
    public function test_translation_files()
    {
        $en = File::getRequire(resource_path() . '/lang/en/app.php');
        $sv = File::getRequire(resource_path() . '/lang/sv/app.php');

        $this->assertNull($this->diff($en, $sv, 'sv'));
        $this->assertNull($this->diff($sv, $en, 'en'));
    }

    private function diff(array $array1, array $array2, string $parent): void
    {
        foreach ($array1 as $key => $value) {
            $item = "{$parent}.{$key}";

            if (! isset($array2[$key])) {
                $this->fail($item . ' does not exist');
            }

            if (empty($array2[$key])) {
                $this->fail($item . ' is empty');
            }

            if (is_array($value)) {
                $this->diff($value, $array2[$key], $item);
            }
        }
    }
}
