<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-orange accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
        </div> --}}
        <div class="sidebar-brand-text mx-3">
            <img src="{{ asset('assets/img/logo.png') }}" alt="LOGO" width="50" height="50">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size:17px;">หน้าหลัก</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ (request()->is('backend/user*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-user-alt text-gray-400"></i>
            <span>ลงทะเบียนลูกค้า</span>
        </a>
    </li>

    <li class="nav-item {{ Route::is('admin.approve.index*') ? 'active' : '' }} {{ Route::is('admin.create.accounting') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.approve.index') }}">
            <i class="fas fa-file-invoice text-gray-400"></i>
            <span>ขอเปิดบิลใหม่</span>
        </a>
    </li>

    <li class="nav-item {{ Route::is('admin.payment.list.index*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.payment.list.index') }}">
            <i class="fas fa-rss text-gray-400"></i>
            <span>รายการชําระใหม่</span>
        </a>
    </li>

    <li class="nav-item {{ Route::is('admin.accounting.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.accounting.index') }}">
            <i class="fas fa-file-invoice text-gray-400"></i>
            <span>ข้อมูลการผ่อน</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.accounting.payment.index*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#status"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-list fa-sm fa-fw text-gray-400"></i>
            <span>สถานะการผ่อน</span>
        </a>
        <div id="status" class="collapse {{ Route::is('admin.accounting.payment.index*') ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::get('filter') == '1' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '1']) }}">ผ่านการพิจารณา</a>
                <a class="collapse-item {{ Request::get('filter') == '2' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '2']) }}">อยู่ระหว่างการพิจารณา</a>
                <a class="collapse-item {{ Request::get('filter') == '3' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '3']) }}">ยกเลิกการผ่อน</a>
                <a class="collapse-item {{ Request::get('filter') == '4' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '4']) }}">พักการผ่อน</a>
                <a class="collapse-item {{ Request::get('filter') == '5' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '5']) }}">รอตรวจสอบเอกสาร</a>
                <a class="collapse-item {{ Request::get('filter') == '6' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '6']) }}">รับสินค้า</a>
                <a class="collapse-item {{ Request::get('filter') == '7' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '7']) }}">ค้างชำระ</a>
                <a class="collapse-item {{ Request::get('filter') == '8' ? 'active' : '' }}" href="{{ route('admin.accounting.payment.index', ['filter' => '8']) }}">ชำระการผ่อนครบ</a>
            </div>
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('myaccount') }}">
            <i class="fas fa-user-alt text-gray-400"></i>
            <span>บัญชีการผ่อนของฉัน</span>
        </a>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-file-invoice text-gray-400"></i>
            <span>ติดต่อทีมงาน</span>
        </a>
    </li> --}}

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        {{-- <a class="nav-link {{ Route::is('admin.setting.index*') ? '' : 'collapsed' }}" href="#">
            <i class="fas fa-cogs fa-sm fa-fw text-gray-400"></i>
            <span>การตั้งค่า</span>
        </a> --}}
        <a class="nav-link {{ Route::is('admin.setting.index*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#setting"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-cogs fa-sm fa-fw text-gray-400"></i>
            <span>การตั้งค่า</span>
        </a>
        <div id="setting" class="collapse {{ Route::is('admin.setting.index*') ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::get('page') == 'installment' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => 'installment']) }}">ประเภทการผ่อน</a>
                <a class="collapse-item {{ Request::get('page') == 'payment' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => 'payment']) }}">ประเภทการชำระ</a>
                <a class="collapse-item {{ Request::get('page') == 'product' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => 'product']) }}">จัดการสินค้า</a>
                <a class="collapse-item {{ Request::get('page') == 'color' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => 'color']) }}">จัดการสีสินค้า</a>
                <a class="collapse-item {{ Request::get('page') == 'capacity' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => 'capacity']) }}">จัดการความจุสินค้า</a>
                <a class="collapse-item {{ Request::get('page') == 'brand' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => 'brand']) }}">จัดการแบรนด์</a>
                {{-- <a class="collapse-item {{ Request::get('page') == '3' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => '3']) }}">ยกเลิกการผ่อน</a>
                <a class="collapse-item {{ Request::get('page') == '4' ? 'active' : '' }}" href="{{ route('admin.setting.index', ['page' => '4']) }}">พักการผ่อน</a> --}}
            </div>
        </div>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a
            class="nav-link"
            href="#"
            onclick="document.getElementById('logoutForm').submit()"
        >
            <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
            <span>ออกจากระบบ</span>
        </a>

        <form action="{{ route('logout') }}" method="post" id="logoutForm" >
            @csrf
        </form>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- Sidebar Message -->
</ul>
<!-- End of Sidebar -->
