<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\ClientBuilder;
use Exception;
use Illuminate\Console\Command;
use App\Models\Plant;
use Elasticsearch;

class IndexPlants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:plants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();
        $plants = Plant::all();

        foreach ($plants as $plant) {
            try {
                $client->bulk([
                    'id' => $plant->id,
                    'index' => 'plants',
                    'body' => [
                        'name' => $plant->name,
                        'history' => $plant->history
                    ]
                ]);
            } catch (Exception $e) {
                $this->info($e->getMessage());
            }
        }

        $this->info("Успешно");
        return Command::SUCCESS;
    }
}
