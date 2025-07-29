<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Language;

class LanguageTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        try {

            $translations = include module_path('Core', 'resources/lang/translations.php');

            if (!is_array($translations)) {
                $this->command->error('Language translations file did not return a valid array.');
                return;
            }

            foreach ($translations as $item) {
                Language::updateOrCreate(
                    [
                        'apply_on_type' => $item['apply_on_type'],
                        'message_id_to_call' => $item['message_id_to_call'],
                    ],
                    [
                        'en'      => $item['en'] ?? null,
                        'bn'      => $item['bn'] ?? null,
                        'cn'      => $item['cn'] ?? null,
                        'th'      => $item['th'] ?? null,
                        'vn'      => $item['vn'] ?? null,
                        'kh'      => $item['kh'] ?? null,
                        'remarks' => $item['remarks'] ?? null,
                    ]
                );
            }

            $this->command->info('Language translations seeded successfully.');
        } catch (\Throwable $e) {

            $this->command->error('Failed to seed language translations: ' . $e->getMessage());
            Log::error('LanguageTranslationSeeder Error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

        }

        // $this->call([]);
    }
}
