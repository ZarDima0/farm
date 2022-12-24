<?php

namespace App\OpenApi\Responses\DefaultResponses;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ResultResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::boolean('result')->example(true)->description('Результат'),
        );

        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
