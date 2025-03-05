<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

declare(strict_types=1);

namespace CWSPS154\AppSettings\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateSettingsTab extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:app-settings-tab';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an app settings tab';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'SettingsTab';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Filament\Settings\Forms';
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return __DIR__.'/stubs/tabClass.stub';
    }

    /**
     * Get the desired class name from the input.
     */
    protected function getNameInput(): string
    {
        return trim($this->argument('name'));
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     */
    protected function replaceClass($stub, $name): string
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $classUpdatedStub = str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);
        $state = Str::snake($this->getNameInput());

        return str_replace(['{{ state }}', '{{state}}'], $state, $classUpdatedStub);
    }
}
