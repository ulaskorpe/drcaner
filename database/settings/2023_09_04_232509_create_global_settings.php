<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.contact', [
            'address' => '',
            'coordinates' => '',
            'email' => '',
            'phone' => '',
            'whatsapp' => '',
        ]);
        
    }
};
