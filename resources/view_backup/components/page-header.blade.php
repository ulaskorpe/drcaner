@if ($headerVideo)

    <div class="pt-10 pb-5 position-relative">

        <video class="bg-video" autoplay muted loop playsinline poster="{{ $headerImage ? $headerImage->getUrl() : '' }}">
            <source src="{{$headerVideo->original_url}}" type="video/mp4">
        </video>

        <div class="overlay bg-v-gradient-reverse-primary opacity-50"></div>

        <div @class(['container position-relative mt-xl-10'])>

            <h1 class="mt-6 position-relative h6 title-style-three ba-bg-white mb-0 text-uppercase fw-normal text-white">{!! $title !!}</h1>
            @if ($subTitle)
            <p class="h2 mb-0 mt-3 mw-xxl-75 fw-bolder text-white">{!! $subTitle !!}</p>
            @endif

        </div>
    </div>

@elseif($headerImage)

    <div class="pt-10 pb-5 position-relative bg-center bg-cover" data-bg-image="{{$headerImage->getUrl()}}">

        <div class="overlay bg-v-gradient-reverse-primary opacity-50"></div>

        <div @class(['container position-relative'])>

            <h1 class="mt-6 position-relative h6 title-style-three ba-bg-white mb-0 text-uppercase fw-normal text-white">{!! $title !!}</h1>
            @if ($subTitle)
            <p class="h2 mb-0 mt-3 mw-xxl-75 fw-bolder text-white">{!! $subTitle !!}</p>
            @endif

        </div>
    </div>

@else

    <div class="bg-v-gradient-reverse-light py-5 border-bottom">
        <div @class(['container'])>

            <h1 class="mt-6 position-relative h6 title-style-three mb-0 text-uppercase fw-normal">{!! $title !!}</h1>
            @if ($subTitle)
            <p class="h2 mb-0 mt-3 mw-xxl-75 fw-bolder">{!! $subTitle !!}</p>
            @endif

        </div>
    </div>

@endif

@if ($breadCrumb)
<div class="bg-light border-bottom">
    <div class="container py-3">
        <x-breadcrumb :data="$breadCrumb['data']" :title="$breadCrumb['title']" />
    </div>
</div>
@endif