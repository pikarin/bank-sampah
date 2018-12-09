<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
        {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->controller($name);
        $this->model($name);
        $this->requests($name);
        $this->views($name);

        File::append(
            base_path('routes/web.php'),
            'Route::resource(\'' . str_plural(strtolower($name)) . "', '{$name}Controller');"
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/{$name}.php"), $modelTemplate);
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function requests($name)
    {
        $storeRequestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('StoreRequest')
        );

        $updateRequestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('UpdateRequest')
        );

        if ( !file_exists($path = app_path('/Http/Requests')))
        {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Requests/Store{$name}.php"), $storeRequestTemplate);
        file_put_contents(app_path("/Http/Requests/Update{$name}.php"), $updateRequestTemplate);
    }

    protected function views($name)
    {
        $pluralName = strtolower(str_plural($name));

        $indexTemplate = str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $pluralName,
                strtolower($name)
            ],
            $this->getStub('views/index')
        );

        $showTemplate = str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $pluralName,
                strtolower($name)
            ],
            $this->getStub('views/show')
        );

        $createTemplate = str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $pluralName,
                strtolower($name)
            ],
            $this->getStub('views/create')
        );

        $editTemplate = str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $pluralName,
                strtolower($name)
            ],
            $this->getStub('views/edit')
        );

        $formTemplate = str_replace(
            [
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $pluralName,
                strtolower($name)
            ],
            $this->getStub('views/form')
        );

        file_put_contents(resource_path("views/{$pluralName}/index.blade.php"), $indexTemplate);
        file_put_contents(resource_path("views/{$pluralName}/show.blade.php"), $showTemplate);
        file_put_contents(resource_path("views/{$pluralName}/create.blade.php"), $createTemplate);
        file_put_contents(resource_path("views/{$pluralName}/edit.blade.php"), $editTemplate);
        file_put_contents(resource_path("views/{$pluralName}/_form.blade.php"), $formTemplate);
    }

    protected function lang($name)
    {
        $nameLower = strtolower($name);

        $langTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('lang')
        );

        file_put_contents(resource_path("lang/en/{$nameLower}.php"), $langTemplate);
    }
}
