<?php
/**
 * Concord CRM - https://www.concordcrm.com
 *
 * @version   1.5.1
 *
 * @link      Releases - https://www.concordcrm.com/releases
 * @link      Terms Of Service - https://www.concordcrm.com/terms
 *
 * @copyright Copyright (c) 2022-2024 KONKORD DIGITAL
 */

use App\ToModuleMigrator;
use Modules\Updater\UpdatePatcher;

return new class extends UpdatePatcher
{
    public function run(): void
    {
        ToModuleMigrator::make('deals')
            ->migrateLanguageFiles(['brand.php'])
            ->deleteConflictedFiles($this->getConflictedFiles());
    }

    public function shouldRun(): bool
    {
        return file_exists(app_path('Models/Brand.php'));
    }

    protected function getConflictedFiles(): array
    {
        return [
            app_path('Models/Brand.php'),
        ];
    }
};