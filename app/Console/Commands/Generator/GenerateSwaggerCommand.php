<?php

namespace App\Console\Commands\Generator;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Vyuldashev\LaravelOpenApi\Generator;

class GenerateSwaggerCommand extends Command
{
    protected $signature = 'openapi:generate {collection=default}';
    protected $description = 'Доп.команда для генерации документации сваггер с сохранением в файл';

    public function handle(Generator $generator): void
    {
        $collectionExists = collect(config('openapi.collections'))->has($this->argument('collection'));

        if (! $collectionExists) {
            $this->error('Collection "'.$this->argument('collection').'" does not exist.');
            return;
        }

        $savePath = public_path('/openapi/' . $this->argument('collection'));
        $file = 'openapi.json';

        if (!File::exists($savePath .'/'. $file)) {
            File::ensureDirectoryExists($savePath);
        }

        File::put($savePath  . '/' . $file,   $generator
            ->generate($this->argument('collection'))
            ->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    }
}
