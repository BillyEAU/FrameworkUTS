<!DOCTYPE html>
<html lang="en">
    @include('layouts.Beranda.master.head')
    <body>
        <!-- Responsive navbar-->
        @include('layouts.Beranda.master.nav')
        @yield('content')
        @include('layouts.Beranda.master.foot')