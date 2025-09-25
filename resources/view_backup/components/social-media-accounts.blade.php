@props([
    'classes' => '',
    'dark' => false
])

@php
    $divClass = ['social-icons'];
    if( !empty($classes) ){
        $divClass[] = $classes;
    }
    if( $dark ){
        $divClass[] = 'dark';
    }
@endphp

<div @class($divClass)>

    @foreach ($settings->socials as $key => $item)
    <a href="{{$item['value']}}" @class([$item['key']])  target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$item['key']}}">
        <i class="bi bi-{{$item['key']}}"></i>
    </a>
    @endforeach
</div>