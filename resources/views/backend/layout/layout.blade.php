<!DOCTYPE html>
<html lang="en">

@include('backend.components.head')

@yield('style')

<body>
  <div class="main-wrapper">

    @include('backend.components.sidebar')

    <div class="page-wrapper">

      @include('backend.components.navbar')

      @yield('content')

    </div>

  </div>

  @include('backend.components.script')
  @include('backend.components.notificaiton')
  @yield('script')
  @stack('scripts')

</body>

</html>