<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('admin.layout.header')
    <div id="wrapper" i="444">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
