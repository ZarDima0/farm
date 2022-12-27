<?php

namespace App\OpenApi\Responses\DefaultResponses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default', 'mobile'])]
class ForbiddenErrorResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::string('message')->example('This action is unauthorized.'),
                Schema::string('exception')->example('string'),
                Schema::string('file')->example('string'),
                Schema::integer('line')->example(387),
                Schema::array('trace')->items(
                    Schema::object()->properties(
                        Schema::string('file')->example('string'),
                        Schema::integer('line')->example(387),
                        Schema::string('function')->example('string'),
                        Schema::string('class')->example('string'),
                        Schema::string('type')->example('string')
                    )
                )
            );

        return Response::forbidden('forbidden')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
