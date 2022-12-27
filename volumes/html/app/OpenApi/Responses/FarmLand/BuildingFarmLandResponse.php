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
class BuildingFarmLandResponse extends ResponseFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::integer('id')->example(1)->description('ID'),
                Schema::integer('farmId')->example(1)->description('ID farmLand'),
                Schema::integer('buildingId')->example(1)->description('ID Building'),
                Schema::object('building')->properties(
                    Schema::string('name')->default('Дом'),
                    Schema::integer('tiles')->default(100)
                )

            );
        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}

