<?php

namespace App\OpenApi\Responses\DefaultResponses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default', 'mobile'])]
class CreatedResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::created('createdResponse');
    }
}
