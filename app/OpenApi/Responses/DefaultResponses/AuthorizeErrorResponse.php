<?php

namespace App\OpenApi\Responses\DefaultResponses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default', 'mobile'])]
class AuthorizeErrorResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::string('message')->example('Unauthenticated.')
            );

        return Response::unauthorized('unauthorizedError')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
