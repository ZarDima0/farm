<?php

namespace App\OpenApi\Responses\Tree;

use App\OpenApi\Constants\OpenApiConstants;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class TreeResponse extends ResponseFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): Response
    {
        $response = Schema::object()
            ->properties(
                Schema::integer('id')->example(1)->description('ID tree'),
                Schema::string('name')->example('Дуб')->description('Название'),
                Schema::integer('tiles')->example('100')->description('100'),
                Schema::integer('height')->example('100')->description('100'),
                Schema::string('crop')->example('crop'),
            );

        return Response::ok()
            ->description(OpenApiConstants::SUCCESS_DESCRIPTION)
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
