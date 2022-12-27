<?php

namespace App\OpenApi\Responses\Auth;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class AuthResponse extends ResponseFactory
{
    /**
     * @return Response
     */
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('token')->example('2131321231231231231')->description('Token'),
        );

        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
