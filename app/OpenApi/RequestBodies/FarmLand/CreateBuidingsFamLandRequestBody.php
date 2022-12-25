<?php

namespace App\OpenApi\RequestBodies\FarmLand;

use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default'])]
class CreateBuidingsFamLandRequestBody extends RequestBodyFactory
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
                    Schema::object()->required('building_id')->properties(
                        Schema::integer('building_id')->example(1),
                    )
                )
            );
    }
}
