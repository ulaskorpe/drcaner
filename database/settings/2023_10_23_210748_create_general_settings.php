<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.cookie_policy_page', null);
        $this->migrator->add('global.kvkk_page', null);
    }
};
