<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1d1e29 !important;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{ asset('assets/img/logo/logo-pralon-white.png') }}" alt="" width="100">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @php
    $menus = DB::table('menus')
        ->leftJoin('sub_menus', 'menus.id', '=', 'sub_menus.menu_id')
        ->select('menus.*', 
                DB::raw('GROUP_CONCAT(sub_menus.name) as sub_menu_names'),
                DB::raw('GROUP_CONCAT(sub_menus.icon) as sub_menu_icons'),
                DB::raw('GROUP_CONCAT(sub_menus.url) as sub_menu_urls'))
        ->groupBy('menus.id')
        ->orderBy('menus.ordering', 'asc')
        ->get();
    @endphp

    @foreach ($menus as $menu)
        @php
            // Ambil daftar sub-menu dalam bentuk array
            $subMenuNames = $menu->sub_menu_names ? explode(',', $menu->sub_menu_names) : [];
            $subMenuIcons = $menu->sub_menu_icons ? explode(',', $menu->sub_menu_icons) : [];
            $subMenuUrls = $menu->sub_menu_urls ? explode(',', $menu->sub_menu_urls) : [];
            $hasSubMenu = count($subMenuNames) > 0;
            $menuCollapseId = 'collapseMenu' . $menu->id; // ID unik untuk collapse
        @endphp

        <li class="nav-item">
            @if ($hasSubMenu)
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#{{ $menuCollapseId }}"
                    aria-expanded="false" aria-controls="{{ $menuCollapseId }}">
                    {!! \App\Helpers\SanitizeHelper::icon($menu->icon) !!}
                    <span>{{ $menu->name }}</span>
                </a>
                <div id="{{ $menuCollapseId }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header text-muted">{{ $menu->name }}:</h6>
                        @foreach ($subMenuNames as $index => $subMenuName)
                            <a class="collapse-item" href="{{ $subMenuUrls[$index] }}">{{ $subMenuName }}</a>
                        @endforeach
                    </div>
                </div>
            @else
                <a class="nav-link" href="{{ $menu->url }}">
                    {!! \App\Helpers\SanitizeHelper::icon($menu->icon) !!}
                    <span>{{ $menu->name }}</span>
                </a>
            @endif
        </li>
    @endforeach

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    @php
        if (count($menus) != 0) {
            @endphp
            <div class="text-center d-none d-md-inline mt-2">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            @php
        }
    @endphp
</ul>