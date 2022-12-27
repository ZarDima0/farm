<?php

namespace App\OpenApi\SecuritySchemes;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use Vyuldashev\LaravelOpenApi\Factories\SecuritySchemeFactory;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['mobile'])]
class MobileAppUserTokenSecurityScheme extends SecuritySchemeFactory
{
    public function build(): SecurityScheme
    {
        return SecurityScheme::create('MobileAppUserTokenSecurityScheme')
            ->name('Authorization')
            ->in(SecurityScheme::IN_HEADER)
            ->type(SecurityScheme::TYPE_API_KEY)
            ->description('строка вида `номер телефона|авторизационный токен` закодированная в base64');
    }
}
