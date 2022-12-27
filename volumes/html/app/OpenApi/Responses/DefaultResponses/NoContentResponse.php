<?php

namespace App\OpenApi\Responses\DefaultResponses;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default', 'mobile'])]
class NoContentResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::create('noContentResponse')
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->statusCode(204);
    }
}
