<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            {{-- Left navbar links --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        {{-- /.navbar --}}

        {{-- Main Sidebar Container --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            {{-- Brand Logo --}}
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="Bank Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Bank Sampah</span>
            </a>

            {{-- Sidebar --}}
            <div class="sidebar">
                {{-- Sidebar user panel (optional) --}}
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{ auth()->user()->name }}
                        </a>
                    </div>
                </div>

                @include('partials._sidebar-menu')
            </div>
            {{-- /.sidebar --}}
        </aside>

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">
            {{-- Content Header (Page header) --}}
            <div class="content-header">
                {{-- <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Starter Page</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid --> --}}
            </div>
            {{-- /.content-header --}}

            {{-- Main content --}}
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            {{-- /.content --}}
        </div>
        {{-- /.content-wrapper --}}

        <footer class="main-footer">
            {{-- To the right --}}
            <div class="float-right d-none d-sm-inline">
                Bank Sampah
            </div>
            {{-- Default to the left --}}
            <strong>By <a href="https://ranesia.com">RANesia</a>. Studio</strong>
        </footer>
    </div>
    {{-- ./wrapper --}}

    {{-- REQUIRED SCRIPTS --}}
    <script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
