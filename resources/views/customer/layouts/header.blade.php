<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="{{ route('customer.home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="" width="60px">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="{{ Route::is('customer.home') ? 'current-list-item' : '' }} h5">
                                <a href="{{ route('customer.home') }}">หน้าแรก</a>
                            </li>
                            <li class="{{ Route::is('customer.payment.register') ? 'current-list-item' : '' }} h5">
                                <a href="{{ route('customer.payment.register') }}">สนใจสินค้า</a>
                            </li>
                            @auth
                                @if (!auth()->user()->hasAdmin())
                                    <li class="{{ Route::is('customer.payment.index*') ? 'current-list-item' : '' }} h5">
                                        <a href="{{ route('customer.payment.index') }}">การผ่อนชำระ</a>
                                    </li>
                                @endif
                            @endauth
                            <li class="{{ Route::is('customer.abount') ? 'current-list-item' : '' }} h5">
                                <a href="{{ route('customer.abount') }}">เกี่ยวกับเรา</a>
                            </li>
                            <li class="{{ Route::is('customer.evalution.index') ? 'current-list-item' : '' }} h5">
                                <a href="{{ route('customer.evalution.index') }}">แบบประเมิน</a>
                            </li>
                            <li class="{{ Route::is('customer.contact') ? 'current-list-item' : '' }} h5">
                                <a href="{{ route('customer.contact') }}">ติดต่อเรา</a>
                            </li>
                            @auth
                                @if (auth()->user()->hasAdmin())
                                    <li class="{{ Route::is('admin.dashboard') ? 'current-list-item' : '' }} h5">
                                        <a href="{{ route('admin.dashboard') }}">ผู้ดูแลระบบ</a>
                                    </li>
                                @endif
                            @endauth
                            <li>
                                <div class="header-icons">
                                    {{-- <a class="shopping-cart" href="cart.html"><i class="fas fa-shopping-cart"></i></a> --}}
                                    <div class="dropdown">
                                        <a class="mobile-hide dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="fas fa-user-circle fa-lg"></i>
                                        </a>
                                        <div class="dropdown-menu shadow shadow-md">
                                            @guest
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('customer.login') }}"
                                            >
                                                <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                                            </a>
                                            @endguest
                                            @auth
                                            <a class="dropdown-item" href="#" onclick="document.getElementById('logoutForm').submit()">
                                                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                                            </a>

                                            <form action="{{ route('logout') }}" method="post" id="logoutForm" >
                                                @csrf
                                            </form>
                                            @endauth
                                        </div>
                                    </div>
                                    {{-- <a class="mobile-hide search-bar-icon" href="#">
                                        <i class="fas fa-search"></i>
                                    </a> --}}
                                </div>
                            </li>
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
