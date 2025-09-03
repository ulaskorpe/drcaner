<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.header_buttons', null);
        $this->migrator->add('global.footer_slogan', null);
    }
};
