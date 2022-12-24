<?php

namespace App\OpenApi\Responses\BuildingFarm;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default'])]
class BuildingFarmResponse extends ResponseFactory
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
                        Schema::string('farmId')->example('ферма 1'),
                        Schema::integer('buildingId')->example(1000),
                        Schema::object()->properties(
                            Schema::string('name')->example('дом'),
                            Schema::integer('tiles')->example('10'),
                        )
                    )
            );
        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
