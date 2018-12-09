<li class="nav-item has-treeview {{
    request()->is($actives) ? 'menu-open' : ''
}}">
    <a href="#" class="nav-link {{ request()->is($actives) ? 'active' : '' }}">
        <i class="nav-icon fas {{ $icon ?? 'fa-circle' }}"></i>
        <p>
            {{ $text }}
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{ $slot }}
    </ul>
</li>
