<?php

namespace App\Models;

use App\Traits\HasLink;
use App\Traits\HasTags;
use Illuminate\Support\Str;
use App\Traits\HasRevisions;
use Spatie\Sluggable\HasSlug;
use App\Traits\HasLibraryMedia;
use App\Traits\HasSlugOriginal;
use Spatie\Searchable\Searchable;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\LogOptions;
use Spatie\Searchable\SearchResult;
use App\Models\Scopes\LanguageScope;
use App\Traits\HasClearCache;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model implements Sortable, Searchable
{
    use SoftDeletes, LogsActivity, HasRevisions, HasLibraryMedia, SortableTrait, HasSlug, HasSlugOriginal,HasLink, HasTags, HasClearCache;

    protected $fillable = [
        'uuid',
        'content_type_id',
        'language',
        'parent_id',
        'name',
        'summary',
        'slug',
        'slug_org',
        'additional',
        'is_published',
        'start_date',
        'end_date',
        'order_column',
        'content',
        'slider_id',
        'attributes',
        'layout_id',
        'header_layout_id',
        'users_only',
        'user_id',
        'read_count',
        'description',
        'created_at',
        'updated_at',
        'pivot_data',
        'depending_content_id',
        'css',
        'seo'
    ];


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'additional' => 'array',
        'content' => 'array',
        'attributes' => 'array',
        'users_only' => 'boolean',
        'pivot_data' => 'array',
        'seo' => 'array',
    ];

    protected static function booted()
    {        
        static::creating(function ($content) {
            if(!$content->uuid) {
                $content->uuid = Str::uuid();
            }
        });

        static::addGlobalScope(new LanguageScope);

        static::addGlobalScope('publishDate', function (Builder $builder) {
            if (request()->route()->getPrefix() !== 'admin') {
                $builder->where(function($qq) {
                    $qq->whereNull('start_date')
                    ->orWhereDate('start_date', '1970-01-01')
                    ->orWhereDate('start_date', '<=', now());
                });
            }
        });

        static::addGlobalScope('endDate', function (Builder $builder) {
            if (request()->route()->getPrefix() !== 'admin') {
                $builder->where(function ($qq) {
                    $qq->whereNull('end_date')
                    ->orWhereDate('end_date', '1970-01-01')
                    ->orWhereDate('end_date', '>=', now());
                });
            }
        });

        static::addGlobalScope('isPublished', function (Builder $builder) {
            if (request()->route()->getPrefix() !== 'admin') {
                $builder->where('is_published',true);
            }
        });

    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function layout() {
        return $this->belongsTo(Layout::class,'layout_id', 'id');
    }

    public function header_layout() {
        return $this->belongsTo(HeaderLayout::class,'header_layout_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->select('id','name','uuid','language')->with('uri');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->select('id','name','uuid','language')->with('uri');
    }

    //bu bagli oldugu
    public function depending_content()
    {
        return $this->belongsTo(self::class, 'depending_content_id', 'id')->select('id','name','uuid','language','attributes','depending_content_id')->with('uri:linkable_id,final_uri');
    }

    //bu sahip oldugu
    public function depending_contents()
    {
        return $this->hasMany(self::class, 'depending_content_id', 'id')->select('id','name','uuid','language','attributes','depending_content_id')->with(['uri:linkable_id,final_uri','library_media']);
    }

    public function connected_contents()
    {
        return $this->hasMany(self::class, 'uuid', 'uuid')->withoutGlobalScope(LanguageScope::class)->select('id','uuid','name','language')->with('uri:linkable_id,final_uri');
    }

    //bununla model base tree yapiyoruz. ayrica tree de basina -- --- gibi ekleme.
    public static function nestable($contents,$level = 0)
    {

        foreach ($contents as $content) {

            $arrows = $level > 0 ? str_repeat('--',$level).' ' : '';
            $content->name = $arrows.$content->name;

            if (!$content->childs->isEmpty()) {
                $content->childs = self::nestable($content->childs,$level+1);
            }

        }

        return $contents;
    }


    public function content_categories(){

        return $this->belongsToMany(
            ContentCategory::class,
            'content_has_categories',
            'content_id',
            'category_id'
        )->select('id','name','language','uuid')->with(['uri:linkable_id,breadcrumb,final_uri']);

    }

    public function content_type(){

        return $this->belongsTo(ContentType::class)->withoutGlobalScope(LanguageScope::class);

    }

    public function slider(){

        return $this->belongsTo(Slider::class);

    }

    public function createBreadCrumb(array $items_arr, $parent){

		$breadcrumb = $items_arr;
		
        if($parent){
            $item = array(
                'title' => $parent->name,
                'url' => '/'.$parent->uri->link
            );

            array_unshift($breadcrumb,$item);

            if( $parent->parent ){
                return $this->createBreadCrumb($breadcrumb,$parent->parent);
            }
        }

		return $breadcrumb;

	}
	public function getBreadCrumb(){
		
		return $this->createBreadCrumb(array(),$this->parent);

	}


    public function headIndex(){

        $heads = searchInArray($this->content,'type','title');

    }

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $this->uri->final_uri
        );
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*','user','layout','header_layout','slider'])
        ->logOnlyDirty();
    }

}
