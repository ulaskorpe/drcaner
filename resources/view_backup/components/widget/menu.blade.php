@php
    
    $selectedMenu = null;
    if( $menu['menu'] ){
        $selectedMenu = \App\Models\Menu::find($menu['menu']['id']);
    }

    $elemDivClasses = ['nav'];

    if( $selectedMenu ){

        if($menu['direction'] == 'vertical'){
            $elemDivClasses[] = 'flex-column';
        }

        if($menu['baseDesignOptions']['class']) $elemDivClasses[] = $menu['baseDesignOptions']['class'];
        if(isset($menu['baseDesignOptions']['position'])) $elemDivClasses[] = $menu['baseDesignOptions']['position'];

        foreach ($menu['baseDesignOptions']['margin'] as $key => $value) {
            if($value) $elemDivClasses[] = $value;
        }
        foreach ($menu['baseDesignOptions']['padding'] as $key => $value) {
            if($value) $elemDivClasses[] = $value;
        }
        
    }

@endphp

@if ($selectedMenu)

@switch($menu['direction'])
    
    @case("horizontal")
    <ul @class($elemDivClasses)>
        @foreach ($selectedMenu->tree as $item)
        <li class="nav-item">
            <a href="{{$item['item_link']}}" class="nav-link fw-semibold">{!! $item['menu_title'] !!}</a>
        </li>
        @endforeach
    </ul>
    @break

    @case("navbar")
    <div class="container">
        <nav class="d-flex align-items-center w-100">
            <ul class="navbar-nav d-none d-xl-flex flex-row flex-nowrap align-items-center justify-content-between w-100">
                @foreach ($selectedMenu->tree as $item)
                @if (count($item['child_nodes']) > 0)
                <li @class(['nav-item dropdown'])>
                    <a href="#" @class(['nav-link','py-3','text-uppercase','dropdown-toggle']) data-bs-toggle="dropdown" aria-expanded="false">{!! $item['menu_title'] !!}</a>
                    <ul class="dropdown-menu mt-n1 border-0 py-0 bg-light">
                        @foreach ($item['child_nodes'] as $sub)
                        <li>
                            <a href="{{$sub['item_link']}}" class="dropdown-item py-3 text-uppercase">{!! $sub['menu_title'] !!}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{$item['item_link']}}" @class(['nav-link','py-3','text-uppercase'])>{!! $item['menu_title'] !!}</a>
                </li>
                @endif
                @endforeach
            </ul>
        </nav>
    </div>
    @break
    
    @default

    @if ($menu['accordeon'])
        @php
            $menuAccId = 'menu-'.Str::uuid();
        @endphp
        <div class="accordion vstack" id="{{$menuAccId}}">
            @foreach ($selectedMenu->tree as $item)
            @php
                $menuItemUuid = Str::uuid();
            @endphp
            <div class="accordion-item rounded-0 border-0">
                <div class="accordion-header border-bottom">
                <button class="accordion-button rounded-0 fw-semibold bg-transparent p-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu-collapse-{{$menuItemUuid}}" aria-expanded="true" aria-controls="menu-collapse-{{$menuItemUuid}}">
                    {!! $item['menu_title'] !!}
                </button>
                </div>
                <div id="menu-collapse-{{$menuItemUuid}}" class="accordion-collapse collapse" data-bs-parent="#{{$menuAccId }}">
                <div class="accordion-body p-3">
                    @if ($item['child_nodes'])
                    <ul class="nav flex-column gap-2">
                        @foreach ($item['child_nodes'] as $child)
                        <li>
                            <a href="{{$child['item_link']}}" class="fs-sm link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{$child['menu_title']}}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                </div>
            </div>
            @endforeach
        </div>

        @else

        <div class="border border-2 border-dark p-3 d-flex flex-column gap-3">
            <ul @class($elemDivClasses)>
                @foreach ($selectedMenu->tree as $item)
                <li class="nav-item py-1 mb-2 text-center border-bottom border-dark border-1">
                    <a href="{{$item['item_link']}}" class="fw-bold font-title text-dark text-uppercase text-decoration-none fs-lg">{!! $item['menu_title'] !!}</a>
                    @if ($item['child_nodes'])
                    <ul class="nav flex-column mt-1 mb-2">
                        @foreach ($item['child_nodes'] as $child)
                        <li>
                            <a href="{{$child['item_link']}}" class="fs-sm link-dark py-1 link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{$child['menu_title']}}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
            <x-social-media-accounts :dark="true" :classes="'justify-content-center'"/>
        </div>

    @endif
        
@endswitch

@endif