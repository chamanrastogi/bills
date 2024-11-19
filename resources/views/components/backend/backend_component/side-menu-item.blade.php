@php
    $ariaControls = !empty($submenu) ? $routeId : '';
@endphp


    <li class="menu">
        <a href="{{empty($submenu) ?'':'#'}}{{ empty($submenu) ? route($routeId): $routeId}}"
        @if (!empty($submenu)) data-bs-toggle="collapse" @endif
           aria-expanded="{{ is_active_route($activeRoutes) }}"
           @if (!empty($submenu)) aria-controls="{{ $ariaControls }}" @endif

           class="dropdown-toggle">
            <div class="">
                <i data-feather="{{ $icon }}"></i> <span>{{ __($label) }}</span>
            </div>
            <div>
                <i data-feather="chevron-right"></i>
            </div>
        </a>

        @if (!empty($submenu))
            <ul class="collapse submenu list-unstyled {{ show_class($activeRoutes) }}" id="{{ $routeId }}"
                data-bs-parent="#accordionExample">
                @foreach ($submenu as $subItem)

                        <li class="{{ active_class($subItem['route']) }}">
                            <a href="{{ route($subItem['route']) }}"> {{ __($subItem['label']) }} </a>
                        </li>

                @endforeach
            </ul>
        @endif
    </li>

