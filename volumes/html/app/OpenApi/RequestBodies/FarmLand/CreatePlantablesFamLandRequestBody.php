<?php

namespace App\OpenApi\RequestBodies\FarmLand;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\Collection(name: ['default'])]
class CreatePlantablesFamLandRequestBody extends RequestBodyFactory
{
    /**
     * @return RequestBody
     */
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(
                    Schema::object()->required('building_id')->properties(
                        Schema::integer('farmland_id')->example(1),
                        Schema::integer('plantable_type')->example('tree'),
                        Schema::integer('plantable_id')->example(1),
                        Schema::integer('count')->example(1),
                        Schema::string('planted_at')->example('10.10.2000'),
                        Schema::string('harvested_at')->example('10.10.2000'),
                    )
                )
            );
    }
}
