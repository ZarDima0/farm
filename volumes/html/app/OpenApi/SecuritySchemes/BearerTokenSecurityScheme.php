<?php

namespace App\OpenApi\SecuritySchemes;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use Vyuldashev\LaravelOpenApi\Factories\SecuritySchemeFactory;

class BearerTokenSecurityScheme extends SecuritySchemeFactory
{
    public function build(): SecurityScheme
    {
        return SecurityScheme::create('BearerToken')
            ->name('bearerAuth')
            ->in(SecurityScheme::IN_HEADER)
            ->type(SecurityScheme::TYPE_HTTP)
            ->scheme('bearer');
    }
}
