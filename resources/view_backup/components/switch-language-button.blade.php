@props([
    'href' => "",
    'language' => config('languages.default')
])

<a href="{{$href}}" class="d-flex align-items-center text-decoration-none fs-xs lh-1 gap-1" title="{{Str::upper($language)}}">
    <img src="{{asset('images/flags/'.$language.'.svg')}}" alt="{{$language}}" width="24" height="24" class="flex-shrink-0">
    <div class="vstack gap-1">
        <span class="text-white">{{ languageName($language) }}</span>
        <span class="text-gray-500 fs-xs">{{Str::upper($language)}}</span>
    </div>
</a>