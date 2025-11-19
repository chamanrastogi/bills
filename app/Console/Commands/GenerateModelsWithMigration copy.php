<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateModelsWithMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:gen {--force : Overwrite existing files}';

    public $folder;

    public $folder_path;

    public $component_folder;

    protected $description = 'Generate multiple models with resource controller methods and migration';

    public function __construct()
    {
        parent::__construct();
        $this->folder_path = 'backend';
        $this->component_folder = 'backend_component';
    }

    // protected $hidden = true; //Hide your custom command
    public function handle()
    {

        // Define the models and their fields with types and options
        $models = [
            'purity' => [

                'name' => ['type' => 'string', 'options' => []],
                // Active or inactive status
                'status' => ['type' => 'boolean', 'options' => ['default' => 0]],

            ],

        ];

        // Loop through the models and create each one with migration and resource methods
        foreach ($models as $model => $fields) {
            $mName = Str::studly(Str::singular($model));
            $form_name = $mName.'Form';

            // Create the model with migration and resource options
            $this->call('make:controller', [
                'name' => 'Backend/'.$mName.'Controller',
                '--resource' => true,
                '--model' => $mName,
            ]);

            // // Create Custom Controller
            $this->createCustomController($mName);

            $this->call('make:migration', [
                'name' => 'create_'.Str::snake(Str::plural($model)).'_table',
                '--create' => Str::snake(Str::plural($model)),
            ]);

            // // Create Data Table
            $this->call('datatables:make', [
                'name' => $mName,
            ]);

            // Create Export Table
            // $this->call('make:export', [
            //     'name' => Str::ucfirst($model)."Export",
            //     '--model' => Str::ucfirst($model)
            // ]);

            // Create Import Table
            // $this->call('make:import', [
            //     'name' => Str::ucfirst($model)."Import",
            //     '--model' => Str::ucfirst($model)
            // ]);

            // Create custom Blade files
            $this->createBladeFiles(strtolower($model));

            $this->createComponentWithDummyData($form_name, strtolower($model));

            // Update the migration file with the specified fields
            $this->addFieldsToMigration($model, $fields);
            $this->info("\n🛠 Generating: {$mName}");
            $this->info('📦 Model, migration, and controller created');
            $this->info("🧱 Blade views: created under resources/views/backend/{$model}");
        }
    }

    protected function addFieldsToMigration($model, $fields)
    {
        // Get the latest migration file
        $migrationFile = $this->getLastMigrationFile();

        if (! $migrationFile || ! file_exists($migrationFile)) {
            $this->error('No migration file found.');

            return;
        }

        // Always start with id() as the first field
        $fieldLines = "            \$table->id();\n";

        foreach ($fields as $field => $properties) {
            // Skip if field name is "id" (we already added it)
            if (strtolower($field) === 'id') {
                continue;
            }

            $type = $properties['type'] ?? 'string';
            $options = $properties['options'] ?? [];

            // Start the field definition
            $line = "\$table->{$type}('{$field}'";

            // If maxLength exists (e.g. string length)
            if (isset($options['maxLength'])) {
                $line .= ", {$options['maxLength']}";
            }

            $line .= ')';

            // Handle options
            if (! empty($options)) {
                if (! empty($options['nullable'])) {
                    $line .= '->nullable()';
                }

                if (array_key_exists('default', $options)) {
                    $defaultValue = $options['default'];
                    $defaultValue = is_numeric($defaultValue) ? $defaultValue : "'{$defaultValue}'";
                    $line .= "->default({$defaultValue})";
                }

                if (! empty($options['useCurrent'])) {
                    $line .= '->useCurrent()';
                }
            }

            $line .= ';';
            $fieldLines .= $line."\n";
        }

        // Add timestamps automatically at the end
        $fieldLines .= "            \$table->timestamp('created_at')->useCurrent();\n";
        $fieldLines .= "            \$table->timestamp('updated_at')->useCurrent();\n";
        // Read migration file content
        $migrationContent = file_get_contents($migrationFile);

        // Replace Schema::create content block with updated field lines
        $newMigrationContent = preg_replace(
            '/Schema::create\(.*?\{[\s\S]*?\}\);/m',
            "Schema::create('".Str::plural(Str::snake($model))."', function (Blueprint \$table) {\n{$fieldLines}        });",
            $migrationContent
        );

        // Save the updated migration file
        file_put_contents($migrationFile, $newMigrationContent);

        $this->info("✅ Migration for '{$model}' updated successfully (with \$table->id() first).");
    }

    protected function getLastMigrationFile()
    {
        $files = glob(database_path('migrations/*.php'));
        usort($files, fn ($a, $b) => filemtime($b) <=> filemtime($a));

        return $files[0] ?? null;
    }

    protected function createBladeFiles(string $model): void
    {

        $modelStudly = Str::studly($model);
        $modelLower = Str::lower($model);

        // Directory where generated blades will be stored
        $bladeDirectory = resource_path("views/backend/{$modelLower}");

        // Create directory if not exists
        if (! File::exists($bladeDirectory)) {
            File::makeDirectory($bladeDirectory, 0755, true);
            $this->info("📁 Blade directory created: {$bladeDirectory}");
        }

        // Locate all .blade.php templates in resources/views/templates
        $templateDir = resource_path('views/templates');
        $templateFiles = File::glob("{$templateDir}/*.blade.php");

        if (empty($templateFiles)) {
            $this->warn("⚠️ No Blade templates found in: {$templateDir}");

            return;
        }

        foreach ($templateFiles as $templatePath) {
            $templateName = basename($templatePath);                    // e.g. create.blade.php
            $baseName = pathinfo($templateName, PATHINFO_FILENAME); // e.g. create.blade
            $baseName = Str::before($baseName, '.blade');            // now "add"
            $destination = "{$bladeDirectory}/{$baseName}_{$modelLower}.blade.php";

            // Skip if already exists (unless force option)
            if (File::exists($destination) && ! $this->option('force')) {
                $this->warn("⏭️ Skipped (already exists): {$destination}");

                continue;
            }

            // Read and process template content
            $content = File::get($templatePath);

            // Replace dynamic placeholders inside template
            $content = str_replace(
                ['{{ModelStudly}}', '{{ModelLower}}'],
                [$modelStudly, $modelLower],
                $content
            );

            // Save the generated Blade file
            File::put($destination, $content);
            $this->info("✅ Blade file created: {$destination}");
        }
    }

    protected function createComponentWithDummyData($form_name, $model)
    {
        // Call the make:component command to create only the component class
        $this->call('make:component', [
            'name' => "{$this->folder_path}/{$this->component_folder}/{$form_name}",
            '--inline' => true,
        ]);

        $slug = $model.'-form';

        // Define the target path to manually create the blade file
        $componentPath = resource_path("views/components/{$this->folder_path}/{$this->component_folder}/{$slug}.blade.php");
        $componentDirectory = dirname($componentPath);

        // Ensure the directory exists
        if (! File::exists($componentDirectory)) {
            File::makeDirectory($componentDirectory, 0755, true);
        }

        $dummyTemplatePath = resource_path('views/templates/component-form.blade.php');

        // Check if the dummy template exists
        if (File::exists($dummyTemplatePath)) {
            $bladeContent = File::get($dummyTemplatePath);

            // Create the view file manually
            File::put($componentPath, $bladeContent);
            $this->info("Blade component view created: {$componentPath}");
        } else {
            $this->error("Dummy template file not found: {$dummyTemplatePath}");
        }
    }

    protected function createCustomController($model)
    {
        $controllerName = $model.'Controller';
        $modelLower = Str::lower($model);

        $stubPath = base_path('resources/views/templates/stubs/custom-controller.stub');
        $targetPath = app_path("Http/Controllers/Backend/{$controllerName}.php");

        if (! File::exists(dirname($targetPath))) {
            File::makeDirectory(dirname($targetPath), 0755, true);
        }

        if (File::exists($stubPath)) {
            $stub = File::get($stubPath);

            // Replace placeholders
            $stub = str_replace(
                ['{{ModelStudly}}', '{{ModelLower}}'],
                [$model, $modelLower],
                $stub
            );

            File::put($targetPath, $stub);
            $this->info("Custom controller created: {$controllerName}");
        } else {
            $this->error("Missing stub file: {$stubPath}");
        }
    }
}
