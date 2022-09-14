<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">API MINEGREAT</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size:17px;">หน้าหลัก</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Interface
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('data_user') }}">
            <i class="fas fa-user-alt text-gray-400"></i>
            <span>สมัครบัญชีลูกค้า</span>
        </a>


        <!-- Nav Item - Tables -->

        <a class="nav-link" href="{{ route('accounting.index') }}">
            <i class="fas fa-file-invoice text-gray-400"></i>
            <span>บัญชีการผ่อน</span>
        </a>


        <!-- Nav Item - Utilities Collapse Menu -->

        <a class="nav-link" href="{{ url('payment') }}">
            <i class="fas fa-coins text-gray-400	"></i>
            <span>การผ่อนชำระ</span>
        </a>
        {{-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#การผ่อนชำระ"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-coins text-gray-400	"></i>
            <span>การผ่อนชำระ</span>
        </a>
        <div id="การผ่อนชำระ" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('payment') }}">จัดการข้อมูลการผ่อนชำระ</a>
                <a class="collapse-item" href="{{ url('check_payment') }}">ตรวจสอบการผ่อนชำระ</a>
            </div>
        </div> --}}


        <!-- Nav Item - Utilities Collapse Menu -->


        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#สถานะการผ่อน"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>สถานะการผ่อน</span>
        </a>
        <div id="สถานะการผ่อน" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                <a class="collapse-item" href="{{ url('check_payment') }}">ผ่านการพิจารณา</a>
                <a class="collapse-item" href="{{ url('payment') }}">อยู่ระหว่างการพิจารณา</a>
                <a class="collapse-item" href="{{ url('payment') }}">ยกเลิกการผ่อน</a>
                <a class="collapse-item" href="{{ url('payment') }}">พักการผ่อน</a>
                <a class="collapse-item" href="{{ url('payment') }}">รอตรวจสอบเอกสาร</a>
                <a class="collapse-item" href="{{ url('check_payment') }}">รับสินค้า</a>
                <a class="collapse-item" href="{{ url('check_payment') }}">ค้างชำระ</a>
                <a class="collapse-item" href="{{ url('check_payment') }}">ชำระการผ่อนครบ</a>
                {{-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a> --}}
            </div>
        </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('myaccount') }}">
            <i class="fas fa-user-alt text-gray-400"></i>
            <span>บัญชีการผ่อนของฉัน</span>
        </a>



        <a class="nav-link">
            <i class="fas fa-file-invoice text-gray-400"></i>
            <span>ติดต่อทีมงาน</span>
        </a>

        <!-- Divider -->



        <hr class="sidebar-divider my-0">

        <a class="nav-link" href="{{ url('accounting') }}">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>การตั้งค่า</span></a>


        <hr class="sidebar-divider my-0">

        <a class="nav-link" href="{{ url('accounting') }}">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>ออกจากระบบ</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->
