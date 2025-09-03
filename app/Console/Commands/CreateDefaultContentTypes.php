<?php

namespace App\Console\Commands;

use App\Models\ContentType;
use Illuminate\Support\Str;
use App\Models\ContentCategory;
use Illuminate\Console\Command;
use App\Settings\GlobalSettings;

class CreateDefaultContentTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-content-types';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Varsayilan icerik tipleri';

    /**
     * Execute the console command.
     */
    public function handle(GlobalSettings $settings)
    {

        $this->info('Varsayilan icerik tipleri oluşturuluyor.');

        $sayfaUuid = Str::uuid();
        $blogUuid = Str::uuid();
        $haberUuid = Str::uuid();
        $faqUuid = Str::uuid();

        foreach (config('languages.active') as $key => $lang) {

            $sayfa = ContentType::create([
                'name' => 'Sayfa - ' . Str::upper($lang),
                'has_category' => false,
                'has_url' => true,
                'is_published' => true,
                'is_deletable' => false,
                'use_taxonomy_link' => false,
                'language' => $lang,
                'additional' => [
                    "adminOptions" => [
                        "icon" => false,
                        "tags" => true,
                        "slider" => true,
                        "gallery" => true,
                        "summary" => true,
                        "mainImage" => true,
                        "mainVideo" => true,
                        "description" => false,
                        "headerImage" => true,
                        "headerLayout" => true,
                        "designElements" => true
                    ]
                ],
                'content_mode' => 'content',
                'uuid' => $sayfaUuid
            ]);

            $blog = ContentType::create([
                'name' => 'Blog - ' . Str::upper($lang),
                'has_category' => true,
                'has_url' => true,
                'is_published' => true,
                'is_deletable' => false,
                'use_taxonomy_link' => true,
                'language' => $lang,
                'additional' => [
                    "adminOptions" => [
                        "icon" => false,
                        "tags" => true,
                        "slider" => true,
                        "gallery" => true,
                        "summary" => true,
                        "mainImage" => true,
                        "mainVideo" => true,
                        "description" => true,
                        "headerImage" => true,
                        "headerLayout" => true,
                        "designElements" => false
                    ]
                ],
                'content_mode' => 'description',
                'uuid' => $blogUuid
            ]);

            $haber = ContentType::create([
                'name' => 'Haber - ' . Str::upper($lang),
                'has_category' => true,
                'has_url' => true,
                'is_published' => true,
                'is_deletable' => false,
                'use_taxonomy_link' => true,
                'language' => $lang,
                'additional' => [
                    "adminOptions" => [
                        "icon" => false,
                        "tags" => true,
                        "slider" => true,
                        "gallery" => true,
                        "summary" => true,
                        "mainImage" => true,
                        "mainVideo" => true,
                        "description" => true,
                        "headerImage" => true,
                        "headerLayout" => true,
                        "designElements" => false
                    ]
                ],
                'content_mode' => 'description',
                'uuid' => $haberUuid
            ]);

            $faq = ContentType::create([
                'name' => 'FAQ - ' . Str::upper($lang),
                'has_category' => true,
                'has_url' => false,
                'is_published' => true,
                'is_deletable' => false,
                'language' => $lang,
                'additional' => [
                    "adminOptions" => [
                        "icon" => false,
                        "tags" => false,
                        "slider" => false,
                        "gallery" => false,
                        "summary" => true,
                        "mainImage" => true,
                        "mainVideo" => false,
                        "description" => false,
                        "headerImage" => false,
                        "headerLayout" => false,
                        "designElements" => false
                    ]
                ],
                'content_mode' => 'content',
                'uuid' => $faqUuid
            ]);
        }

        $settings->blog_content_type = $blogUuid;
        $settings->news_content_type = $haberUuid;
        $settings->faq_content_type = $faqUuid;

        $settings->save();

        $this->info('Varsayilan icerik tipleri oluşturuldu.');
    }
}
