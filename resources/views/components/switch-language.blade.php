@props([
    'connecteds' => []
])
 @php
    $currentLanguage = app()->getLocale();
    $dropdownId = 'languageDropdown-' . uniqid();
@endphp

<div class="dropdown">
    <button class="btn btn-link dropdown-toggle d-flex align-items-center text-decoration-none fs-xs lh-1 gap-1 p-0" type="button" id="{{ $dropdownId }}" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('images/flags/' . $currentLanguage . '.svg') }}" alt="{{ $currentLanguage }}" width="24" height="24" class="flex-shrink-0">
        <div class="vstack gap-1 text-start">
            <span class="text-white">{{ languageName($currentLanguage) }}</span>
            <span class="text-gray-500 fs-xs">{{ Str::upper($currentLanguage) }}</span>
        </div>
    </button>

    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="{{ $dropdownId }}">
        @foreach (config('languages.active') as $lang)
            @php
                $lang_exists = Arr::first($connecteds, function ($value, $key) use ($lang) {
                    return $value['language'] === $lang;
                });

                if ($lang_exists) {
                    if ($lang_exists->uuid == $settings->home_page) {
                        if ($lang_exists['language'] == config('languages.default')) {
                            $href = config('app.url');
                        } else {
                            $href = config('app.url') . '/' . $lang;
                        }
                    } else {
                        $href = $lang_exists['uri']['final_uri'];
                    }
                } else {
                    if ($lang == config('languages.default')) {
                        $href = config('app.url');
                    } else {
                        $href = config('app.url') . '/' . $lang;
                    }
                }
            @endphp

            <li>
                <x-switch-language-button :href="$href" :language="$lang" />
            </li>
        @endforeach
    </ul>
</div>