<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
    <div id="app">
    @include('layouts.navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
@include('layouts.footer')
</body>
</html>
