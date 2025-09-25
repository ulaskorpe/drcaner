@php
    $navbarClasses = 'navbar navbar-expand cs-navbar py-0';
    $linkClasses = 'nav-link';
    $buttonOneClass = 'btn-outline-white px-5 text-uppercase';
    $buttonTwoClass = 'btn-light text-uppercase';
    $logo = isset($settings->logo['main']) ? $settings->logo['main'] : null;
    $logoMobile = isset($settings->logo['mobile']) ? $settings->logo['mobile'] : null;

    if( $headerLayout ){

        if( isset($headerLayout['json_data']['backgroundClass']) && !empty($headerLayout['json_data']['backgroundClass']) ){
            $navbarClasses = 'navbar navbar-expand cs-navbar py-0 '.$headerLayout['json_data']['backgroundClass'];
        }

        if( isset($headerLayout['json_data']['linkColorClass']) && !empty($headerLayout['json_data']['linkColorClass']) ){
            $linkClasses = 'nav-link '.$headerLayout['json_data']['linkColorClass'];
        }

        if( isset($headerLayout['json_data']['headerButtonOneClass']) && !empty($headerLayout['json_data']['headerButtonOneClass']) ){
            $buttonOneClass = $headerLayout['json_data']['headerButtonOneClass'];
        }

        if( isset($headerLayout['json_data']['headerButtonTwoClass']) && !empty($headerLayout['json_data']['headerButtonTwoClass']) ){
            $buttonTwoClass = $headerLayout['json_data']['headerButtonTwoClass'];
        }

        if( isset($headerLayout['json_data']['logo']['main']) && !empty($headerLayout['json_data']['logo']['main']) ){
            $logo = $headerLayout['json_data']['logo']['main'];
        }

        if( isset($headerLayout['json_data']['logo']['mobile']) && !empty($headerLayout['json_data']['logo']['mobile']) ){
            $logoMobile = $headerLayout['json_data']['logo']['mobile'];
        }

    }

    $logoLink = '/';
    if( app()->getLocale() != config('languages.default') ){
        $logoLink = '/'.app()->getLocale();
    }

@endphp


@if ($isMobile)

<header @class([$navbarClasses]) id="main-mobile-navbar new-font" >
    <!-- DIŞ WRAPPER: satır yerine kolon -->
    <div class="d-flex flex-column w-100 p-2 gap-2" aria-label="Top Navigation">
      <!-- 1. SATIR: LOGO (aynen kalsın) -->
      <div class="text-center">
        <a href="{{$logoLink}}" class="logo d-inline-block"> @if ($logoMobile) <img src="{{ $logoMobile['original_url'] }}" alt="{{ $settings->site_name }}" width="{{ $logoMobile['custom_properties']['width'] }}" height="{{ $logoMobile['custom_properties']['height'] }}"> @elseif ($logo) <img src="{{ $logo['original_url'] }}" alt="{{ $settings->site_name }}" width="{{ $logo['custom_properties']['width'] }}" height="{{ $logo['custom_properties']['height'] }}"> @else <span>{{ $settings->site_name }}</span> @endif </a>
      </div>
      <!-- 2. SATIR: SOL TELEFON — SAĞ MENÜ -->
      <div class="d-flex justify-content-between align-items-center">
        <!-- Sol: Telefon -->


        @php

        $whatsappPhone = preg_replace('/[^0-9]/', '', $settings->contact['phone']);
    @endphp


    @php

        $mapAddress = urlencode(strip_tags($settings->contact['address']));
    @endphp


        <a href="https://wa.me/{{ $whatsappPhone }}" target="_blank"  class="phone-btn d-inline-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="me-2" viewBox="0 0 16 16">
            <path d="M3.654 1.328a.678.678 0 0 1 .738-.067l2.522 1.26a.678.678 0 0 1 .291.91L6.29 5.255a.678.678 0 0 0 .145.79l3.52 3.52a.678.678 0 0 0 .79.145l1.824-.915a.678.678 0 0 1 .91.29l1.26 2.523a.678.678 0 0 1-.067.738c-.69.987-1.77 1.817-3.095 1.817-3.315 0-7.29-3.975-7.29-7.29 0-1.325.83-2.405 1.817-3.095z" />
          </svg> {{$settings->contact['address']}}</a>
        <!-- Sağ: Menü (mevcut kodun) -->
        <div class="d-flex align-items-center">
          <button class="btn text-white p-0 align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#csNavbar" aria-controls="csNavbar" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" class="bi" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
          </button>
          <div id="google_translate_element"  ></div>
        </div>
      </div>
    </div>
  </header>
  <style>
    #main-mobile-navbar .phone-btn {
      background: #3a4853;
      color: #fff;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 700;
      font-family: 'Montserrat'
      text-decoration: none;
      line-height: 1.1;
    }

    #main-mobile-navbar .phone-btn:hover {
      opacity: .9;
      color: #fff;
    }
  </style>
@else

    <header class="bg-black new-font"  >

        <div class="container py-3 d-none d-lg-block">
            <div class="row row-cols-3 justify-content-between align-items-center">
                <div class="col d-flex flex-column">
                    @php
                        $whatsappPhone = preg_replace('/[^0-9]/', '', $settings->contact['phone']);
                    @endphp
                    <a href="https://wa.me/{{ $whatsappPhone }}" target="_blank" class="text-decoration-none">
                        <span class="lead text-gray-500">{{ $settings->contact['phone'] }}</span>
                    </a>
                    @php
                        $mapAddress = urlencode(strip_tags($settings->contact['address']));
                    @endphp
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $mapAddress }}" target="_blank" class="text-decoration-none">
                        <span class="text-white fs-sm">{!! $settings->contact['address'] !!}</span>
                    </a>
                </div>
                <div class="col">
                    <a href="/">
                    <img src="/media/2025/6/2/logo-full.png" alt="Dr. Caner Kaçmaz" fetchpriority="high" width="409" height="127" class="img-fluid mx-auto">
                </a>
                </div>
                <div class="col d-flex flex-column align-items-end gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="hstack gap-3 ms-auto">
                            @if (isset($settings->header_buttons[app()->getLocale()]))
                            <div class="hstack align-items-center gap-2">
                                @if ($settings->header_buttons[app()->getLocale()]['button_1']['active'])
                                <a href="{{$settings->header_buttons[app()->getLocale()]['button_1']['button_link']}}" @class(['btn btn-sm px-3 h-40px d-flex text-nowrap align-items-center fw-semibold',$buttonOneClass]) @if ($settings->header_buttons[app()->getLocale()]['button_1']['new_window']) target="_blank" @endif>
                                    {!! $settings->header_buttons[app()->getLocale()]['button_1']['button_text'] !!}
                                </a>
                                @endif
                                @if ($settings->header_buttons[app()->getLocale()]['button_2']['active'])
                                <a href="{{$settings->header_buttons[app()->getLocale()]['button_2']['button_link']}}" @class(['btn btn-sm px-3 h-40px d-flex text-nowrap align-items-center fw-semibold',$buttonTwoClass]) @if ($settings->header_buttons[app()->getLocale()]['button_2']['new_window']) target="_blank" @endif>
                                    {!! $settings->header_buttons[app()->getLocale()]['button_2']['button_text'] !!}
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                         
                        @if(true)
                        
                        <div class="d-none d-xl-block ms-3 rounded bg-opacity-75 bg-dark px-3 py-2">
                            <x-switch-language />
                        </div>
                        @endif
                    </div>
                    <x-social-media-accounts />
                </div>
            </div>
        </div>

        <div @class([$navbarClasses]) id="main-navbar">

            <div class="container">
                <nav class="d-flex align-items-center w-100" aria-label="Main navigation">
                    @if (session()->has('core_menus') && isset(session()->get('core_menus')['data'][app()->getLocale()]['main']))

                        <div class="d-flex d-xl-none align-items-center py-2 w-100">

                            <a href="{{$logoLink}}" class="logo">
                                @if ($logo)
                                <img src="{{ $logo['original_url'] }}" alt="{{ $settings->site_name }}" width="{{ $logo['custom_properties']['width'] }}" height="{{ $logo['custom_properties']['height'] }}">
                                @else
                                <span>{{ $settings->site_name }}</span>
                                @endif
                            </a>

                            <button class="btn text-white text-hover-secondary p-0 border-0 hstack gap-2 ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#csNavbar" aria-controls="csNavbar" aria-label="Toggle navigation">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="bi" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                                </svg>
                                <span>MENÜ</span>
                            </button>
                        </div>

                        <ul class="navbar-nav d-none d-xl-flex flex-row flex-nowrap align-items-center justify-content-between w-100">
                            <li>
                                <a href="{{$logoLink}}" class="logo">
                                    @if ($logo)
                                    <img src="{{ $logo['original_url'] }}" alt="{{ $settings->site_name }}" width="{{ $logo['custom_properties']['width'] }}" height="{{ $logo['custom_properties']['height'] }}">
                                    @else
                                    <span>{{ $settings->site_name }}</span>
                                    @endif
                                </a>
                            </li>
                            @foreach (session()->get('core_menus')['data'][app()->getLocale()]['main']['items'] as $item)
                            @if (count($item['child_nodes']) > 0)
                            <li @class(['nav-item dropdown','ktm-mega-menu'=> $item['megamenu']])>
                                <a href="#" @class([$linkClasses,'dropdown-toggle','new-font']) data-bs-toggle="dropdown" aria-expanded="false">{!! $item['menu_title'] !!}</a>
                                @if ($item['megamenu'])
                                <div class="dropdown-menu new-font">
                                    <div class="bg-white pt-3 pb-5 min-h-500px border-bottom">
                                        <nav class="container large-container">
                                            <ul class="row row-cols-2 row-cols-lg-4 row-cols-xl-5 g-4 list-unstyled ps-0">
                                                @foreach ($item['child_nodes'] as $sub)
                                                <li class="col pt-3">
                                                    <a class="vstack gap-2 text-decoration-none text-uppercase" href="{{$sub['item_link']}}">
                                                        @if ($sub['image'])
                                                        <div class="overflow-hidden h-150px hover-image-scale">
                                                            <img loading="lazy" src="{{ $sub['image'] }}" alt="{{ $sub['menu_title'] }}" class="w-100 h-100 object-fit-cover">
                                                        </div>
                                                        @endif
                                                        <span class="title-style-five fw-bold text-uppercase">{!! $sub['menu_title'] !!}</span>
                                                        @if (isset($sub['item_desc']) && !empty($sub['item_desc']))
                                                        <small class="text-primary">{{$sub['item_desc']}}</small>
                                                        @endif
                                                    </a>
                                                    @if ($sub['child_nodes'])
                                                    <ul class="list-unstyled mt-2 mb-0 vstack gap-2">
                                                        @foreach ($sub['child_nodes'] as $third)
                                                        <li>
                                                            <a href="{{ $third['item_link'] }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{!! $third['menu_title'] !!}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                @else
                                <ul class="dropdown-menu new-font">
                                    @foreach ($item['child_nodes'] as $sub)
                                    <li>
                                        <a href="{{$sub['item_link']}}" class="dropdown-item text-uppercase new-font menu-item">{!! $sub['menu_title'] !!} </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @else
                            <li class="nav-item">
                                <a href="{{$item['item_link']}}" @class([$linkClasses,'new-font']) >{!! $item['menu_title'] !!}</a>
                            </li>
                            @endif

                            @endforeach

                        </ul>

                    @endif

                </nav>
            </div>

        </div>

    </header>

@endif

{{-- offcanvas ekran boyutuna gore desktop icin de kullanılabilir. --}}

<div @class(['offcanvas offcanvas-end bg-black']) tabindex="-1" id="csNavbar" data-bs-scroll="false">
    <div class="offcanvas-header px-3 py-3">
        <button type="button" class="btn text-white p-0 border-0 shadow-none bg-transparent ms-auto" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#csNavbar"><i class="bi bi-x-lg fs-3"></i></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">

        @if (session()->has('core_menus') && isset(session()->get('core_menus')['data'][app()->getLocale()]['main']))
        <nav>
            <ul class="list-unstyled d-flex flex-column gap-3">
                @foreach (session()->get('core_menus')['data'][app()->getLocale()]['main']['items'] as $item)
                <li>
                    <a href="{{$item['item_link']}}" @class(['main-level link-light text-decoration-none'])>{!! $item['menu_title'] !!}</a>
                    @if (count($item['child_nodes']) > 0)
                    <ul class="list-unstyled d-flex flex-column gap-1 mb-2 mt-1">
                        @foreach ($item['child_nodes'] as $sub)
                        <li>
                            <a href="{{$sub['item_link']}}" class="text-light text-decoration-none fw-semibold new-font menu-item">{!! $sub['menu_title'] !!}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </nav>
        @endif

        @if (config('languages.language_bar'))
        <div class="mt-auto rounded bg-gray-800 p-3">
            <x-switch-language />
        </div>
        @endif

        <div>
        @if (isset($settings->header_buttons[app()->getLocale()]))
            <div class="vstack gap-2 mt-4">
                @if ($settings->header_buttons[app()->getLocale()]['button_1']['active'])
                <a href="{{$settings->header_buttons[app()->getLocale()]['button_1']['button_link']}}" @class(['btn btn-sm p-3 d-flex align-items-center justify-content-center fw-bolder text-uppercase h-40px',$buttonOneClass]) @if ($settings->header_buttons[app()->getLocale()]['button_1']['new_window']) target="_blank" @endif>
                    {!! $settings->header_buttons[app()->getLocale()]['button_1']['button_text'] !!}
                </a>
                @endif
                @if ($settings->header_buttons[app()->getLocale()]['button_2']['active'])
                <a href="{{$settings->header_buttons[app()->getLocale()]['button_2']['button_link']}}" @class(['btn btn-sm p-3 d-flex align-items-center justify-content-center fw-bolder text-uppercase h-40px',$buttonTwoClass]) @if ($settings->header_buttons[app()->getLocale()]['button_2']['new_window']) target="_blank" @endif>
                    {!! $settings->header_buttons[app()->getLocale()]['button_2']['button_text'] !!}
                </a>
                @endif

            </div>
        @endif
        </div>

    </div>
</div>
