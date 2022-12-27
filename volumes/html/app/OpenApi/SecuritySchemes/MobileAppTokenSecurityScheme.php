<?php

namespace App\OpenApi\SecuritySchemes;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use Vyuldashev\LaravelOpenApi\Factories\SecuritySchemeFactory;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['mobile'])]
class MobileAppTokenSecurityScheme extends SecuritySchemeFactory
{
    public function build(): SecurityScheme
    {
        return SecurityScheme::create('MobileAppTokenSecurityScheme')
            ->name('Authorization')
            ->in(SecurityScheme::IN_HEADER)
            ->type(SecurityScheme::TYPE_API_KEY)
            ->description('авторизационный токен');
    }
}
