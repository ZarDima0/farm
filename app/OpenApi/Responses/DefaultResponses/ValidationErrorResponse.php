<?php

namespace App\OpenApi\Responses\DefaultResponses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default', 'mobile'])]
class ValidationErrorResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::string('code')->example('VALIDATION'),
                Schema::string('message')->example('Message'),
                Schema::object('errors')->properties(
                    Schema::array('field')->items(
                        Schema::string('message')
                            ->example('Поле обязательно для заполнения')
                    )
                )
            );

        return Response::badRequest('badRequest')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
