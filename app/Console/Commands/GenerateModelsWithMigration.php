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

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate multiple models with resource controller methods, migration, views, and components.';

    protected string $folderPath = 'backend';

    protected string $componentFolder = 'backend_component';

    /**
     * Define the models and their fields configuration.
     */
    protected function configuration(): array
    {
        return [
            'category' => [
                'id' => ['type' => 'id', 'options' => []],
                'name' => ['type' => 'string', 'options' => []],
                'status' => ['type' => 'boolean', 'options' => ['default' => 0]],
            ],
            // Add more models here...
        ];
    }

    public function handle()
    {
        $models = $this->configuration();

        foreach ($models as $modelName => $fields) {
            // Pre-calculate naming conventions to ensure consistency
            $meta = [
                'name' => $modelName,
                'studly' => Str::studly(Str::singular($modelName)), // Purity
                'lower' => Str::lower($modelName), // purity
                'plural_snake' => Str::snake(Str::plural($modelName)), // purities
                'singular_snake' => Str::snake(Str::singular($modelName)), // purity
            ];

            $this->info("\n🛠  Processing: {$meta['studly']}...");
             $this->call('make:model', [
                'name' => Str::ucfirst($modelName),

            ]);
            $this->generateController($meta);
            $this->generateMigration($meta, $fields);
            $this->generateDataTable($meta);
            $this->generateBladeFiles($meta);
            $this->generateComponent($meta);

            $this->info("✅ All tasks completed for {$meta['studly']}.");
        }
    }

    /**
     * Generate the Custom Controller from Stub.
     */
    protected function generateController(array $meta): void
    {
        $controllerName = "{$meta['studly']}Controller";
        $targetPath = app_path("Http/Controllers/Backend/{$controllerName}.php");
        $stubPath = base_path('resources/views/templates/stubs/custom-controller.stub');

        if (! $this->option('force') && File::exists($targetPath)) {
            $this->warn('   ⏭️ Controller already exists. Skipping.');

            return;
        }

        if (! File::exists($stubPath)) {
            $this->error("   ❌ Stub file not found: {$stubPath}");

            return;
        }

        $content = File::get($stubPath);
        $content = str_replace(
            ['{{ModelStudly}}', '{{ModelLower}}'],
            [$meta['studly'], $meta['lower']],
            $content
        );

        $this->ensureDirectoryExists(dirname($targetPath));
        File::put($targetPath, $content);

        $this->info("   📦 Controller created: {$controllerName}");
    }

    /**
     * Create Migration and inject fields.
     */
    protected function generateMigration(array $meta, array $fields): void
    {
        $tableName = $meta['plural_snake'];
        $migrationName = "create_{$tableName}_table";

        // 1. Create basic migration file via Artisan
        $this->callSilent('make:migration', [
            'name' => $migrationName,
            '--create' => $tableName,
        ]);

        // 2. Inject fields
        $migrationFile = $this->getLastMigrationFile();

        if (! $migrationFile) {
            $this->error('   ❌ Could not locate the generated migration file.');

            return;
        }

        $fieldSchema = $this->buildMigrationFields($fields);
        $migrationContent = File::get($migrationFile);

        // Regex to replace the Schema::create closure body
        $newContent = preg_replace(
            '/Schema::create\(.*?\{[\s\S]*?\}\);/m',
            "Schema::create('{$tableName}', function (Blueprint \$table) {\n{$fieldSchema}        });",
            $migrationContent
        );

        File::put($migrationFile, $newContent);
        $this->info('   📦 Migration created and updated with fields.');
    }

    /**
     * Generate DataTables class.
     */
    protected function generateDataTable(array $meta): void
    {
        // Using callSilent to reduce console noise
        $this->callSilent('datatables:make', [
            'name' => $meta['studly'],
        ]);
        $this->info('   📦 DataTable created.');
    }

    /**
     * Generate Blade Views from Templates.
     */
    protected function generateBladeFiles(array $meta): void
    {
        $bladeDirectory = resource_path("views/backend/{$meta['lower']}");
        $this->ensureDirectoryExists($bladeDirectory);

        $templateDir = resource_path('views/templates');
        $templateFiles = File::glob("{$templateDir}/*.blade.php");

        if (empty($templateFiles)) {
            $this->warn("   ⚠️ No templates found in {$templateDir}");

            return;
        }

        foreach ($templateFiles as $templatePath) {
            $baseName = Str::before(pathinfo($templatePath, PATHINFO_FILENAME), '.blade'); // e.g., "create"
            $destination = "{$bladeDirectory}/{$baseName}_{$meta['lower']}.blade.php";

            if (File::exists($destination) && ! $this->option('force')) {
                continue;
            }

            $content = File::get($templatePath);
            $content = str_replace(
                ['{{ModelStudly}}', '{{ModelLower}}'],
                [$meta['studly'], $meta['lower']],
                $content
            );

            File::put($destination, $content);
        }

        $this->info("   🧱 Blade views created in resources/views/backend/{$meta['lower']}");
    }

    /**
     * Generate View Component and Blade.
     */
    protected function generateComponent(array $meta): void
    {
        $formName = "{$meta['studly']}Form";
        $componentPath = "{$this->folderPath}/{$this->componentFolder}/{$formName}";

        // 1. Create the Component Class
        $this->callSilent('make:component', [
            'name' => $componentPath,
            '--inline' => true,
        ]);

        // 2. Overwrite the view manually (Hybrid approach)
        // Laravel components with --inline usually don't have a view file,
        // but your logic suggests you want a specific blade file for it.

        $slug = "{$meta['lower']}-form";
        $viewPath = resource_path("views/components/{$this->folderPath}/{$this->componentFolder}/{$slug}.blade.php");
        $dummyTemplatePath = resource_path('views/templates/component-form.blade.php');

        if (File::exists($dummyTemplatePath)) {
            $this->ensureDirectoryExists(dirname($viewPath));
            File::put($viewPath, File::get($dummyTemplatePath));
            $this->info("   🧩 Component view created: {$slug}");
        } else {
            $this->warn('   ⚠️ Component dummy template missing.');
        }
    }

    /**
     * Construct the migration schema string.
     */
    protected function buildMigrationFields(array $fields): string
    {
        $lines = ['            $table->id();'];

        foreach ($fields as $name => $props) {
            if (strtolower($name) === 'id') {
                continue;
            }

            $type = $props['type'] ?? 'string';
            $options = $props['options'] ?? [];

            // Build: $table->string('name', 255)
            $definition = "\$table->{$type}('{$name}'";
            if (isset($options['maxLength'])) {
                $definition .= ", {$options['maxLength']}";
            }
            $definition .= ')';

            // Chain options: ->nullable()->default(0)
            if (! empty($options['nullable'])) {
                $definition .= '->nullable()';
            }
            if (array_key_exists('default', $options)) {
                $val = is_numeric($options['default']) ? $options['default'] : "'{$options['default']}'";
                $definition .= "->default({$val})";
            }
            if (! empty($options['useCurrent'])) {
                $definition .= '->useCurrent()';
            }

            $lines[] = "            {$definition};";
        }

        $lines[] = "            \$table->timestamp('created_at')->useCurrent();";
        $lines[] = "            \$table->timestamp('updated_at')->useCurrent();\n";

        return implode("\n", $lines);
    }

    /**
     * Helper to find the most recently created migration file.
     */
    protected function getLastMigrationFile(): ?string
    {
        $files = glob(database_path('migrations/*.php'));
        if (! $files) {
            return null;
        }

        // Sort by modification time descending
        usort($files, fn($a, $b) => filemtime($b) <=> filemtime($a));

        return $files[0];
    }

    /**
     * Helper to ensure directory exists.
     */
    protected function ensureDirectoryExists(string $path): void
    {
        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}
