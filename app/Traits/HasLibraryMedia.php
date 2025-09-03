<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasLibraryMedia
{
    public function library_media(): BelongsToMany
    {
        return $this->morphToMany(Media::class, 'model', 'model_has_medias', 'model_id')->withPivot('collection');
    }

    public function getLibraryMediaGroupAttribute()
    {
        return $this->library_media->groupBy('pivot.collection');
    }

    public function getMediaObjectsAttribute()
    {
        return [
            'mainImage' => $this->library_media->firstWhere(fn($media) => $media->pivot->collection === 'mainImage'),
            'headerImage' => $this->library_media->firstWhere(fn($media) => $media->pivot->collection === 'headerImage'),
            'galleryImages' => $this->library_media->where(fn($media) => $media->pivot->collection === 'galleryImages'),
            'mainVideo' => $this->library_media->firstWhere(fn($media) => $media->pivot->collection === 'mainVideo'),
            'mainFile' => $this->library_media->firstWhere(fn($media) => $media->pivot->collection === 'mainFile'),
        ];
    }

    //asagidakiler sadece tek basina gerekirse direkt ulasim icin.
    public function main_image()
    {
        return $this->library_media()->wherePivot('collection', 'mainImage')->first();
    }

    public function header_image()
    {
        return $this->library_media()->wherePivot('collection', 'headerImage')->first();
    }

    public function main_video()
    {
        return $this->library_media()->wherePivot('collection', 'mainVideo')->first();
    }

    public function header_video()
    {
        return $this->library_media()->wherePivot('collection', 'headerVideo')->first();
    }

    public function gallery_images(): BelongsToMany
    {
        return $this->library_media()->wherePivot('collection', 'galleryImages');
    }

    public function main_file()
    {
        return $this->library_media()->wherePivot('collection', 'mainFile')->first();
    }
}
