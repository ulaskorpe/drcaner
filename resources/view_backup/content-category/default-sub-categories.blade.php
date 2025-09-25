@php
    $childs = $content->childs->loadMissing([
        'library_media',
        'uri'
    ]);

    $cardLayout = $content->content_type->card_layout;
@endphp


@if ($childs->count() > 0)
<section class="child-section">
    <div class="container">
        <div class="row g-3 g-xl-5 row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach ($childs as $key => $child)
            <div class="col">
                <div class="card w-100 h-100 child-card align-items-center">
                    @if ($child->media_objects['mainImage'])
                    <img loading="lazy" src="{{$child->media_objects['mainImage']->original_url}}" class="img-fluid card-img-top" width="{{$child->media_objects['mainImage']->custom_properties['width']}}" height="{{$child->media_objects['mainImage']->custom_properties['height']}}" alt="{{$child->name}}">
                    @else
                    <i class="bi bi-image display-1 text-gray-400"></i>
                    @endif
                    <div class="card-body vstack gap-2">
                        <h2 class="lead-responsive mb-0">{{$child->name}}</h2>
                        @if($child->summary)
                        <p class="fs-6 mb-0">{{ Str::limit(strip_tags($child->summary),100,'...') }}</p>
                        @endif
                        <div class="mt-auto pt-3">
                            <a class="btn btn-secondary btn-sm rounded-pill px-3 stretched-link" href="{{$child->uri->final_uri}}">Detaylı Bilgi <i class="bi bi-arrow-right ms-2 fs-6"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<x-content-list :category="$content" :card-layout="$cardLayout" :column-count="2"/>
@endif