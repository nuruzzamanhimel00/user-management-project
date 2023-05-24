<!doctype html>
<html class="no-js" lang="en">

<head>
    <x-partials.header />

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include("backend.layouts.sidebar")
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    @include("backend.layouts.task-notification")
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            @yield('page-title')
            <!-- page title area end -->
            <div class="main-content-inner">
                {{-- @yield('content') --}}
                {{ $slot }}

            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
           <x-partials.footer />
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    @include("backend.layouts.script")
    @stack('script')
</body>

</html>