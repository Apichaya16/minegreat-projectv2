<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="{{ route('customer.home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="{{ Route::is('customer.home') ? 'current-list-item' : '' }}">
                                <a href="{{ route('customer.home') }}">หน้าแรก</a>
                            </li>
                            <li class="{{ Route::is('customer.abount') ? 'current-list-item' : '' }}">
                                <a href="{{ route('customer.abount') }}">เกี่ยวกับเรา</a>
                            </li>
                            <li class="{{ Route::is('customer.contact') ? 'current-list-item' : '' }}">
                                <a href="{{ route('customer.contact') }}">ติดต่อเรา</a>
                            </li>
                            <li>
                                <div class="header-icons">
                                    {{-- <a class="shopping-cart" href="cart.html"><i class="fas fa-shopping-cart"></i></a> --}}
                                    <a
                                        href="#"
                                        onclick="document.getElementById('logoutForm').submit()"
                                    >
                                        ออกจากระบบ
                                    </a>
                                    <a class="mobile-hide search-bar-icon" href="#">
                                        <i class="fas fa-search"></i>
                                    </a>

                                    <form action="{{ route('logout') }}" method="post" id="logoutForm" >
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            {{-- <li><a href="news.html">News</a>
                                <ul class="sub-menu">
                                    <li><a href="news.html">News</a></li>
                                    <li><a href="single-news.html">Single News</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->
