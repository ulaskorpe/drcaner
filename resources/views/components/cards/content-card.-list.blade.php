@if ($content->uri)
<a href="{{$content->uri->final_uri}}" class="w-100 d-flex flex-column gap-2 text-black text-decoration-none">
@else
<div class="w-100 d-flex flex-column gap-2 text-black">
@endif

    @if ($useDate)
    <small class="text-muted">
        <i class="bi bi-calendar me-2"></i>{{$content->start_date->format('d.m.Y')}}
    </small>
    @endif
    <div class="font-title fw-bold">{{$content->name}}</div>
    @if($useSummary && $content->summary)
    <p class="fs-sm mb-0">{{ Str::limit(strip_tags($content->summary),100,'...') }}</p>
    @endif

@if ($content->uri)
</a>
@else
</div>
@endif