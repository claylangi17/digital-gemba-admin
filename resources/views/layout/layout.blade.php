<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />

<body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

    <!-- ..::  header area start ::.. -->
    <x-sidebar />
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        @include('sweetalert::alert')

        <!-- ..::  navbar start ::.. -->
        <x-navbar />
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">
            
            <!-- ..::  breadcrumb  start ::.. -->
            <x-breadcrumb title='{{ isset($title) ? $title : "" }}' subTitle='{{ isset($subTitle) ? $subTitle : "" }}' />
            <!-- ..::  header area end ::.. -->

            @yield('content')
        
        </div>
        <!-- ..::  footer  start ::.. -->
        <x-footer />
        <!-- ..::  footer area end ::.. -->

    </main>

    <!-- ..::  template scripts  start ::.. -->
    <x-script  script='{!! isset($script) ? $script : "" !!}' />
    <!-- ..::  template scripts  end ::.. -->

    {{-- user script start  --}}
    @yield('user-script')
    {{-- user script end  --}}
</body>

</html>