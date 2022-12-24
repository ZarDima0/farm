<?php

namespace App\OpenApi\Responses\FarmLand;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default'])]
class FarmLandResponse extends ResponseFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): Response
    {
        $response = Schema::array()
            ->items(
                Schema::object()->required('id', 'name', 'tiles')
                    ->properties(
                        Schema::integer('id')->example(1),
                        Schema::string('name')->example('ферма 1'),
                        Schema::integer('tiles')->example(1000),
                    )
            );

        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
