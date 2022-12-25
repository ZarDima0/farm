<?php

namespace App\OpenApi\Schemas\User;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default', 'mobile'])]
class UserAddressSchema extends SchemaFactory implements Reusable
{
    /**
     * @return SchemaContract
     * @throws InvalidArgumentException
     */
    public function build(): SchemaContract
    {
        return Schema::object('UserAddress')->properties(
            Schema::integer('id')->example(1),
            Schema::string('name')->example('Дом'),
            Schema::object('city')->properties(
                Schema::integer('id')->example(1),
                Schema::string('name')->example('Барнаул')
            ),
            Schema::string('street')->example('Ленина'),
            Schema::string('houseNumber')->example(10),
            Schema::string('corpus')->nullable()->example(1),
            Schema::string('entrance')->nullable()->example(1),
            Schema::string('floor')->nullable()->example(5),
            Schema::string('flat')->nullable()->example(123),
            Schema::string('intercom')->nullable()->example('#113*'),
            Schema::object('coordinates')->required('longitude', 'latitude')
                ->properties(
                    Schema::number('longitude')->example(83.76719),
                    Schema::number('latitude')->example(53.3578)
                ),
            Schema::boolean('isMain')->example(false),
        );
    }
}
