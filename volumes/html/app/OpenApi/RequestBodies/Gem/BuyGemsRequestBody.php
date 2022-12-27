<?php

namespace App\OpenApi\RequestBodies\Gem;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default'])]
class BuyGemsRequestBody extends RequestBodyFactory
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
                    Schema::object()->required('name')->properties(
                        Schema::integer('gemAmount')->example(100),
                        Schema::string('currency')->example('RUB'),
                    )
                )
            );
    }
}
