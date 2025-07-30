<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Language;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class CoreLanguageSeeder extends Seeder
{
    protected string $module_name;

    public function __construct(string $module_name = 'Core')
    {
        $this->module_name = $module_name;
    }

    /**
     * Run Database Seed
     */
    public function run(): void
    {
        // Step 1: Seed Current Module Translation
        $this->seedModuleTranslation($this->module_name);

        // Step 2: Loop All Modules
        $moduleBasePath = base_path('Modules');
        $modules = File::directories($moduleBasePath);

        foreach ($modules as $module) {
            $moduleName = basename($module);

            // Skip self to avoid infinite recursion
            if ($moduleName === $this->module_name) {
                continue;
            }

            $seederClass = "Modules\\{$moduleName}\\Database\\Seeders\\{$moduleName}LanguageSeeder";

            if (class_exists($seederClass)) {
                $this->call($seederClass);
            } else {
                $this->command->warn("Seeder class not found for module: {$moduleName}");
            }
        }
    }

    /**
     * Seed translation file for specific module
     */
    protected function seedModuleTranslation(string $module)
    {
        try {
            $filePath = module_path($module, 'resources/lang/translations.php');

            if (!file_exists($filePath)) {
                $this->command->warn("Translations file not found for module: {$module}");
                return;
            }

            $translations = include $filePath;

            if (!is_array($translations)) {
                $this->command->error("Invalid translation array in module: {$module}");
                return;
            }

            foreach ($translations as $item) {
                Language::updateOrCreate(
                    [
                        'apply_on_type' => $item['apply_on_type'],
                        'message_id_to_call' => $item['message_id_to_call'],
                    ],
                    [
                        'en' => $item['en'] ?? null,
                        'bn' => $item['bn'] ?? null,
                        'cn' => $item['cn'] ?? null,
                        'th' => $item['th'] ?? null,
                        'vn' => $item['vn'] ?? null,
                        'kh' => $item['kh'] ?? null,
                        'remarks' => $item['remarks'] ?? null,
                    ]
                );
            }

            $this->command->info("{$module} language translations seeded successfully.");
        } catch (\Throwable $e) {
            $this->command->error("Failed to seed {$module} language translations: " . $e->getMessage());
            Log::error("{$module} LanguageTranslationSeeder Error", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
