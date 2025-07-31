<?php

namespace Modules\NVOCC\Database\Seeders;

use Modules\Core\Database\Seeders\CoreLanguageSeeder;

class NVOCCLanguageSeeder extends CoreLanguageSeeder
{
    public function __construct()
    {
        parent::__construct('NVOCC');
    }

    public function run(): void
    {
        // Avoid full module loop, just seed this module only
        $this->seedModuleTranslation($this->module_name);
    }
}
