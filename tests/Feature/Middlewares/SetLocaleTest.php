<?php

namespace Tests\Feature\Middlewares;

use Tests\TestCase;

class SetLocaleTest extends TestCase
{
    public function test_from_browser()
    {
        $this->withHeaders(['Accept-Language' => 'en-US'])->get('/');
        $this->assertEquals('en', app()->getLocale());
    }

    public function test_from_session_if_set()
    {
        $this->withSession(['locale' => 'en'])->get('/');
        $this->assertEquals('en', app()->getLocale());
    }

    public function test_default_when_unknown_value_in_browser()
    {
        $this->withSession(['locale' => 'xx'])->get('/');
        $this->assertEquals('sv', app()->getLocale());
    }

    public function test_default_when_unknown_value_in_session()
    {
        $this->withHeaders(['Accept-Language' => 'xx-YY'])->get('/');
        $this->assertEquals('sv', app()->getLocale());
    }
}
