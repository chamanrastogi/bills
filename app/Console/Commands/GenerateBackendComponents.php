<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateBackendComponents extends Command
{
    protected $signature = 'app:generate-chaman';

    protected $description = 'Generate multiple models with resource controller methods and migration';

    //protected $hidden = true; //Hide your custom command
    public function handle()
    {

        // Define the models and their fields with types and options
        $models = [
            'payment' => [
                'id' => ['type' => 'id', 'options' => []],
                'customer_id' => ['type' => 'integer', 'options' => []],
                'amount' => ['type' => 'integer', 'options' => []],
                'payment_mode' => ['type' => 'integer', 'options' => []],
                'status' => ['type' => 'boolean', 'options' => ['default' => 0]]
            ],
        ];


        // Loop through the models and create each one with migration and resource methods
        foreach ($models as $model => $fields) {
            $form_name = $model . "Form";
            // Create the model with migration and resource options
            $this->call('make:model', [
                'name' => Str::ucfirst($model),
                '--migration' => true,
                '--resource' => true,
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
            $this->info("Model $model , $form_name, Migartion created successfully with migration and resource controller methods.");
        }
    }

    protected function addFieldsToMigration($model, $fields)
    {
        // Get the last migration file created
        $migrationFile = $this->getLastMigrationFile();

        // Prepare the fields to be added to the migration
        $fieldLines = '';
        foreach ($fields as $field => $properties) {
            $line = "\$table->{$properties['type']}('{$field}'"; // Start line

            // Add maxLength if it exists
            if (isset($properties['options']['maxLength'])) {
                $maxLength = $properties['options']['maxLength'];
                $line .= ", {$maxLength}"; // Append maxLength
            }
            // Add options
            if (isset($properties['options'])) {
                foreach ($properties['options'] as $option => $value) {
                    if ($option === 'default') {
                        $line .= ")->default({$value}"; // Default value
                    } elseif ($option === 'nullable' && $value) {
                        $line .= ")->nullable("; // Nullable
                    } elseif ($option === 'useCurrent' && $value) {
                        $line .= ")->useCurrent("; // Use current timestamp
                    }
                }
            }

            $line .= ");"; // Close the line with a semicolon
            $fieldLines .= "\n" . $line; // Append to field lines
        }


        // Read the migration file content
        $migrationContent = file_get_contents($migrationFile);
        $model = Str::plural($model);
        // Prepare the new content with fields, excluding the default id and timestamps
        $newMigrationContent = preg_replace(
            '/Schema::create\(\s*\'(.*?)\'\s*,\s*function\s*\(Blueprint\s*\$table\)\s*{[^}]*?}/',
            "Schema::create('$model', function (Blueprint \$table) {\n$fieldLines\n}",
            $migrationContent
        );

        // Write the updated content back to the migration file
        file_put_contents($migrationFile, $newMigrationContent);
    }




    protected function getLastMigrationFile()
    {
        $files = glob(database_path('migrations/*.php'));
        return end($files);
    }

    protected function createBladeFiles($name)
    {
        $bladeDirectory = resource_path("views/backend/{$name}");

        if (!File::exists($bladeDirectory)) {
            File::makeDirectory($bladeDirectory, 0755, true);
            $this->info("Blade directory created: {$bladeDirectory}");
        }

        // Define paths for the template files
        $filePaths = [
            'add' => resource_path("views/templates/create.blade.php"),
            'edit' => resource_path("views/templates/edit.blade.php"),
            'all' => resource_path("views/templates/show.blade.php"),
        ];

        // Loop through the array to create each Blade file
        foreach ($filePaths as $type => $path) {
            if (File::exists($path)) {
                $bladeContent = File::get($path);
                File::put("{$bladeDirectory}/{$type}_{$name}.blade.php", $bladeContent);
                $this->info("Blade file created: {$bladeDirectory}/{$type}_{$name}.blade.php");
            } else {
                $this->error("Template file not found: {$path}");
            }
        }
    }
    protected function createComponentWithDummyData($form_name, $model)
    {
        // Call the make:component command to create the component
        $this->call('make:component', ['name' => "backend/backend_component/{$form_name}"]);

        $slug = $model . "-form";
        // Define the path to the newly created component view
        $componentPath = resource_path("views/components/backend/backend_component/{$slug}.blade.php");

        $dummyTemplatePath = resource_path("views/templates/component-form.blade.php"); // Adjust the path as necessary

        // Check if the component view exists
        if (File::exists($componentPath)) {
            // Check if the dummy template exists
            if (File::exists($dummyTemplatePath)) {
                // Read the content from the dummy template
                $bladeContent = File::get($dummyTemplatePath);

                // Write the dummy content to the component view
                File::put($componentPath, $bladeContent);
                $this->info("Component created with dummy data: {$componentPath}");
            } else {
                $this->error("Dummy template file not found: {$dummyTemplatePath}");
            }
        } else {
            $this->error("Failed to create component view: {$componentPath}");
        }
    }
}
