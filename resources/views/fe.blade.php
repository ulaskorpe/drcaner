<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        {{ seo()->render() }}

		<meta name="author" content="{{config('app.name')}}">
		<meta name="robots" content="index, follow, noodp, noydir">
		<meta content="width=device-width, initial-scale=1, maximum-scale=5" name="viewport">
		<meta name="format-detection" content="telephone=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (isset($settings->logo['favicon']['original_url']))
        <link href="{{ $settings->logo['favicon']['original_url'] }}" rel="shortcut icon">
        @endif

        {{--Bu canonical isini seo tool da cozebiliyor muyuz bakalim--}}
        <link rel="canonical" href="{{ request()->url() }}">

        @if (isset($connecteds) && $connecteds->count() > 0)
        @foreach ($connecteds as $connected)
        @if ( $connected->uuid == $settings->home_page )
        @if ($connected['language'] == config('languages.default'))
        <link rel="alternate" href="{{ config('app.url') }}" hreflang="{{$connected->language}}">
        @else
        <link rel="alternate" href="{{ config('app.url') .'/'. $connected->language }}" hreflang="{{$connected->language}}">
        @endif
        @else
        <link rel="alternate" href="{{ $connected->uri->final_uri }}" hreflang="{{$connected->language}}">
        @endif
        @endforeach

        @endif

        {{--
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        --}}

        <link rel="preload" href="/fe/css/fonts/InriaSerif-Bold.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/InriaSerif-Regular.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/InriaSerif-Light.woff2" as="font" type="font/woff2" crossorigin>

        <link rel="preload" href="/fe/css/fonts/Inter-Bold.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/Inter-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/Inter-Light.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/Inter-Medium.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/Inter-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="/fe/css/fonts/bootstrap-icons.woff2?24e3eb84d0bcaf83d77f904c78ac1f47" as="font" type="font/woff2" crossorigin>

        <link rel="preload" href="{{ mix('/fe/css/main.css') }}" as="style">
        <link rel="preload" href="{{ mix('/fe/css/vendors.css') }}" as="style">

        @stack('preload')

        <link rel="stylesheet" href="{{ mix('/fe/css/main.css') }}">

        {!! $settings->scripts['header'] !!}

        {{ $headerScripts ?? '' }}

        @if ($message = Session::get('form_after_fields'))
		<script id="form-submit-fields">
            const formSubmitFields = @json($message);
        </script>
		@endif

        @if ($message = Session::get('formAfterSubmit'))
        {!! $message !!}
        @endif

        @stack('head')
        <style>

        .fixed-global {
  position: fixed;
  top: 100px;
  z-index: 9999;
}
        .sticky-global{
  position: fixed;
  top: 200px;      /* ihtiyacına göre */
     /* ihtiyacına göre */
  z-index: 9999;
  width: 320px;    /* sabit bir genişlik ver ya da aşağıdaki 2. yöntemi kullan */
}
.sticky-right {
  top: 100px;

  z-index: 99;
}
.fixed {
  position: fixed;
}
.absolute {
  position: absolute;
}

.custom-box {

}

.top-25 {
  top:200px !important;
}

.menu-item {
    padding: 10px 15px;       /* Menü öğesi iç boşluğu */
    border-bottom: 1px solid #ccc;  /* İnce çizgi */
    padding-top: 5px;
}
            .new-font{
                font-family: 'Montserrat' !important;

            }
            /* Google Translate ikonunu tamamen kaldırır */
            .goog-te-gadget-icon {
              display: none !important;
            }

            /* Widget'ın ana container'ını şeffaf yapar ve kenarlıklarını sıfırlar */
            .goog-te-gadget-simple {



              border: none !important;
              padding: 0 !important;
              margin: 0 !important;
            }

            /* Seçili dili gösteren metnin rengini ayarlar */
            /* Sitenizin arka planı koyu ise bu rengi beyaz (#FFFFFF) yapmanız gerekebilir */
            .goog-te-gadget-simple .goog-te-menu-value span {

              color: #fff !important; /* Yazı rengi SİYAH */
              text-decoration: none !important;
              border: none !important;
            }

            /* Dropdown oku için ek stil (opsiyonel) */
            .goog-te-gadget-simple .goog-te-menu-value img {
               background-image: none !important;
            }
            #main-navbar .dropdown-menu .dropdown-submenu,
            #main-navbar .dropdown-menu .dropend {
        position: relative;
    }

    #main-navbar .dropdown-menu .dropdown-submenu > .dropdown-menu,
    #main-navbar .dropdown-menu .dropend > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .25rem;
        min-width: 12rem;
        position: absolute;
        display: none;
    }

    #main-navbar .dropdown-menu .dropdown-submenu:hover > .dropdown-menu,
    #main-navbar .dropdown-menu .dropdown-submenu:focus-within > .dropdown-menu,
    #main-navbar .dropdown-menu .dropend:hover > .dropdown-menu,
    #main-navbar .dropdown-menu .dropend:focus-within > .dropdown-menu {
        display: block;
    }

    #main-navbar .dropdown-menu .dropdown-submenu > a,
    #main-navbar .dropdown-menu .dropend > a {
        white-space: normal;
    }

    #csNavbar .submenu-list a {
        font-size: .95rem;
        color: #d1d5db;
    }

    #csNavbar .submenu-list a:hover {
        color: #ffffff;
    }

    @media (max-width: 1199.98px) {
        #main-navbar .dropdown-menu .dropdown-submenu > .dropdown-menu,
        #main-navbar .dropdown-menu .dropend > .dropdown-menu {
            position: static;
            margin-left: 0;
        }
    }
          </style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    </head>
    <body @class(['d-flex flex-column overflow-x-hidden'])>

        {!! $settings->scripts['afterBody'] !!}

        {{ $afterBodyScripts ?? '' }}

        @include('includes/navbar',['content' => $content, 'isHome' => $isHome, 'headerLayout' => $headerLayout ?? null])

        {{ $pageHeader ?? '' }}

        <x-flash-message />

        <main>
            {{ $slot }}
        </main>

        <div class="mt-auto">
            @if ($settings->footer_layout[app()->getLocale()] && count($settings->footer_layout[app()->getLocale()]['content']) > 0)
                @foreach ($settings->footer_layout[app()->getLocale()]['content'] as $section)


                <x-section :section="$section"/>
                @endforeach
            @endif
            @include('includes/footer')
        </div>

        @include('cookie-consent::index')


        <div class="offcanvas offcanvas-size-xxxl offcanvas-end border-0" tabindex="-1" id="dynamic-offcanvas">
            <div class="offcanvas-header lead-responsive fw-semibold border-0 bg-primary text-white py-3 px-4">
                <span class="offcanvas-title" id="dynamic-offcanvas-title"></span>
                <button type="button" class="btn box-30 p-0 d-flex align-items-center justify-content-center rounded-circle bg-white text-primary ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="offcanvas-body px-0 py-4" id="dynamic-offcanvas-body">
                <div class="ps-4">
                    <div class="spinner-border spinner-border-lg" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
            </div>
        </div>
<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body" id="contactModalBody">
        <!-- İçerik buraya yüklenecek -->
        <div class="text-center py-5" id="contactLoading" style="display:none;">
          Yükleniyor…
        </div>
      </div>
    </div>
  </div>
</div>

        {{ $footerScriptsSource ?? '' }}

        <link rel="stylesheet" href="{{ mix('/fe/css/vendors.css') }}">
        <script src="{{ asset('/fe/js/vendors.js') }}" defer></script>
        <script src="{{ asset('/fe/js/main.js') }}" defer></script>

        <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"

  crossorigin="anonymous"></script>

        {!! $settings->scripts['footer'] !!}

        {{ $footerScripts ?? '' }}

        @stack('footer')


            <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    <script type="text/javascript">
 function showModal(){
    $.get( "http://drcaner.test/contact-form", function( data ) {
  $( "#contactModalBody" ).html( data );

});
}
                        const sticky = document.querySelector(".custom-box");
 //const scrollBottom = document.documentElement.scrollHeight - window.scrollY - window.innerHeight;

                   if(window.innerWidth > 1024){

               window.addEventListener("scroll", () => {
                   console.log(document.documentElement.scrollHeight);
                 //  console.log(window.innerWidth);



                                            if (window.scrollY < 500 || window.scrollY > document.documentElement.scrollHeight - 1200) {
                              sticky.classList.remove("sticky-top" , "sticky-right", "sticky-global");
                            } else {
                              sticky.classList.add("sticky-top" , "sticky-right", "sticky-global");
                            }


  });

                   }else{
                    sticky.classList.remove("sticky-top", "sticky-column", "sticky-right", "sticky-global"); sticky.classList.add("row");
               }
            // function googleTranslateElementInit() {
            //   new google.translate.TranslateElement({
            //     pageLanguage: 'tr',
            //     includedLanguages: 'tr,en,de',
            //     layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            //     autoDisplay: false
            //   }, 'google_translate_element');
            }


             ////




            </script>

    </body>
</html>
