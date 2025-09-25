<x-fe-layout :header-layout="$content->header_layout">

    @if (data_get($content->additional, 'hideHeader') === false)
    <x-page-header 
        :header-video="$content->media_objects['mainVideo']" 
        :title="$content->page_title"
        :header-image="$content->media_objects['headerImage']" 
        :parent-title="$content->parent ? $content->parent->name : ''" 
        :sub-title="isset($content->additional['subTitle']) ? $content->additional['subTitle'] : ''"
        :content-attributes="$content->attributes ?? []"
        :bread-crumb="['data' => $content->uri->breadcrumb ?? [],'title' => $content->name]"
    />
    @endif
    

    @if ($content->content && count($content->content) > 0)
        @foreach ($content->content as $section)
        <x-section :section="$section" :content="$content"/>
        @endforeach
    @endif
    
    @if ($content->content_type->content_category_default_list_type)
    @include('content-category.default-'.$content->content_type->content_category_default_list_type)
    @endif

    <x-slot name="headerScripts">
        @if (isset($content->additional['headerScripts']))
        {!! $content->additional['headerScripts'] !!}
        @endif
    </x-slot>

    <x-slot name="footerScripts">
        @if (isset($content->additional['footerScripts']))
        {!! $content->additional['footerScripts'] !!}
        @endif
    </x-slot>

</x-fe-layout>