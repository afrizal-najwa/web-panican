    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>@yield('title')</title>

        @stack('prepend-style')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
        <link href="/style/main.css" rel="stylesheet" />
        <link
            href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.css"
            rel="stylesheet">
        @stack('addon-style')
    </head>

    <body>
        <div class="page-dashboard">
            <div class="d-flex" id="wrapper" data-aos="fade-right">
                <!-- Sidebar -->
                <div class="border-right" id="sidebar-wrapper">
                    <div class="sidebar-heading text-center">
                        <a href="{{ route('home') }}">
                            <img src="/images/admin.png" alt="" class="my-4" style="max-width: 100px" />
                        </a>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin-dashboard') }}"
                            class="list-group-item list-group-item-action">Dashboard Store</a>
                        <a href="{{ route('admin-statistics') }}" class="list-group-item list-group-item-action {{ request()->is('admin/statistics') ? 'active' : '' }}">
                            Dashboard Pengelolaan Sampah
                        </a>
                        <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/product') ? 'active' : '' }}">
                            Products
                        </a>
                        <a href="{{ route('product-gallery.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/product-gallery*') ? 'active' : '' }}">
                            Galleries
                        </a>
                        <a href="{{ route('category.index') }}"
                            class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">
                            Categories
                        </a>
                        <a href="{{ route('transaction.index') }}"
                            class="list-group-item list-group-item-action {{ request()->is('admin/transaction*') ? 'active' : '' }}">
                            Transactions
                        </a>
                        <a href="{{ route('user.index') }}"
                            class="list-group-item list-group-item-action {{ request()->is('admin/user*') ? 'active' : '' }}">
                            Users
                        </a>
                        @auth
                            <a class="list-group-item list-group-item-action" href="{{ route('logout.perform') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                                
                            <form id="logout-form" action="{{ route('logout.perform') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </div>
                </div>
                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <div id="page-content-wrapper">
                    {{-- Navigation --}}
                    <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto d-none d-lg-flex">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('home') }}" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="/images/icon-user.png" alt=""
                                            class="rounded-circle mr-2 profile-picture" />
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-inline-block mt-2" href="#">
                                        <img src="/images/icon-cart-empty.svg" alt="" />
                                    </a>
                                </li>
                            </ul>
                            <!-- Mobile Menu -->
                            <ul class="navbar-nav d-block d-lg-none mt-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li>
                                    @auth
                                        <a class="nav-link" href="{{ route('logout.perform') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout.perform') }}" method="GET" style="display: none;">
                                            @csrf
                                        </form>
                                    @endauth
                                </li>
                            </ul>
                        </div>
                    </nav>

                    {{-- Content --}}
                    @yield('content')

                </div>
                <!-- /#page-content-wrapper -->
            </div>
        </div>
        <!-- Bootstrap core JavaScript -->
        @stack('prepend-script')
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script
            src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.js">
        </script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        @stack('addon-script')
    </body>

    </html>
