<?php

namespace App\OpenApi\RequestBodies\Auth;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default'])]
class LoginRequestBody extends RequestBodyFactory
{
    /**
     * @return RequestBody
     * @throws InvalidArgumentException
     */
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(
                    Schema::object()->required('email','password')->properties(
                        Schema::string('email')->example('dima@gmail.com'),
                        Schema::integer('password')->example(123456),
                    )
                )
            );
    }
}
