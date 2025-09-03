<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.site_name', env('APP_NAME'));
        $this->migrator->add('global.site_active', true);
    }
};
