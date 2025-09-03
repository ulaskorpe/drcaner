<?php

namespace App\Models;

use App\Traits\HasLink;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use App\Traits\HasLibraryMedia;
use App\Traits\HasSlugOriginal;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\LogOptions;
use App\Models\Scopes\LanguageScope;
use App\Traits\HasClearCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasRevisions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentCategory extends Model
{
    use HasFactory, LogsActivity, HasRevisions,SoftDeletes, HasLibraryMedia, SortableTrait, HasSlug, HasSlugOriginal,HasLink, HasClearCache;

    protected $fillable = [
        'uuid',
        'content_type_id',
        'language',
        'parent_id',
        'name',
        'summary',
        'description',
        'slug',
        'additional',
        'is_published',
        'start_date',
        'end_date',
        'order_column',
        'is_deletable',
        'content',
        'users_only',
        'pivot_data',
        'header_layout_id',
        'layout_id',
        'seo'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_deletable' => 'boolean',
        'additional' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'content' => 'array',
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

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->select('id','name','uuid','language')->with('uri');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->select('id','name','uuid','language')->with('uri');
    }

    public function layout() {
        return $this->belongsTo(Layout::class,'layout_id', 'id');
    }
    
    public function header_layout() {
        return $this->belongsTo(HeaderLayout::class,'header_layout_id', 'id');
    }

    public function connected_categories()
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

    public function contents(){

        return $this->belongsToMany(
            Content::class,
            'content_has_categories',
            'category_id',
            'content_id'
        );

    }

    public function content_type(){

        return $this->belongsTo(ContentType::class)->withoutGlobalScope(LanguageScope::class);

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


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->logOnlyDirty();
    }
    
}
