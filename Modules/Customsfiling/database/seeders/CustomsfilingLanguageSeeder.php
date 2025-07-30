<?php

namespace Modules\Customsfiling\Database\Seeders;

use Modules\Core\Database\Seeders\CoreLanguageSeeder;

class CustomsfilingLanguageSeeder extends CoreLanguageSeeder
{
    public function __construct()
    {
        parent::__construct('Customsfiling');
    }

    public function run(): void
    {
        // Avoid full module loop, just seed this module only
        $this->seedModuleTranslation($this->module_name);
    }
}
