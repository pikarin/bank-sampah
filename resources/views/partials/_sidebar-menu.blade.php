<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @include('partials._nav-item', [
            'text' => 'Dashboard',
            'href' => '/home',
            'active' => 'home*',
            'icon' => 'fa-tachometer-alt',
        ])

        @component('nav-treeview', [
            'text' => 'Management',
            'actives' => ['garbage*', 'types*'],
            'icon' => 'fa-cog',
        ])
            @include('partials._nav-item', [
                'text' => 'Data Sampah',
                'href' => route('garbage.index'),
                'active' => 'garbage*',
                'icon' => 'fa-boxes',
            ])

            @include('partials._nav-item', [
                'text' => 'Data Jenis Sampah',
                'href' => '#',
                'active' => 'types*',
                //'icon' => 'fa-user',
            ])
        @endcomponent

        @include('partials._nav-item', [
            'text' => 'Profile',
            'href' => '#',
            'active' => 'profile*',
            'icon' => 'fa-user',
        ])

        @include('partials._nav-item', [
            'text' => 'Logout',
            'href' => '#',
            'icon' => 'fa-power-off',
        ])
    </ul>
</nav>
