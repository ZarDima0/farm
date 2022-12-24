<?php

namespace App\OpenApi\Responses\Plant;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class PlantResponse extends ResponseFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::integer('id')->example(1)->description('ID plants'),
                Schema::string('name')->example('Розовый куст')->description('Название'),
                Schema::boolean('isPerennial')->example(true),
                Schema::boolean('isHarvestable')->example(false),
                Schema::string('crop')
                );
        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
