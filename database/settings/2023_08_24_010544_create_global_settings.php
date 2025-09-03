<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.home_page', '');
        $this->migrator->add('global.scripts', []);
    }
};
