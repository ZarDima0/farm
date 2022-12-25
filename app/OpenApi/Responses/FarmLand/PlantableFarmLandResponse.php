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
class PlantableFarmLandResponse extends ResponseFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::integer('id')->example(1),
                Schema::integer('farmlandId')->example(1),
                Schema::string('plantableType')->example('tree'),
                Schema::integer('plantableId')->example(1),
                Schema::integer('count')->example(1),
                Schema::string('plantedAt')->example('2000-10-10 00:00:00'),
                Schema::string('harvestedAt')->example('2000-10-10 00:00:00'),
                Schema::object('crop')->properties(
                    Schema::integer('id')->example(1),
                    Schema::string('name')->example('Кедр'),
                    Schema::integer('tiles')->example(1),

                )
            );
        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
