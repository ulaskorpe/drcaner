<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global.blog_content_type', '');
        $this->migrator->add('global.news_content_type', '');
        $this->migrator->add('global.faq_content_type', '');
    }
};
