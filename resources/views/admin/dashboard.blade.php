@extends('layouts.menu')
@section('name_page', 'สรุปข้อมูลโดยรวม')
@section('content')

<div class="row">
    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            ผ่านการพิจารณา</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 1)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            อยู่ระหว่างการพิจารณา</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 2)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            ยกเลิกการผ่อน</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 3)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            พักการผ่อน</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 4)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            รอตรวจสอบเอกสาร</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 5)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            รับสินค้า</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 6)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            ค้างชำระ</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 7)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            ชำระการผ่อนครบ</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $accounts->where('status_type', 8)->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="card-body">
            @foreach ($installmentTypes as $item)
                <h4 class="small font-weight-bold">
                    {{ $item->name }}
                    <span class="float-right">{{ $accounts->where('type_pay', $item->it_id)->count() }}</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            @endforeach
        </div>

        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="myPieChart" width="379" height="245" style="display: block; width: 379px; height: 245px;"
                    class="chartjs-render-monitor"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <span class="mr-2">
                    <i class="fas fa-circle text-primary"></i> Direct
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle text-success"></i> Social
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle text-info"></i> Referral
                </span>
            </div>
        </div>
    </div>




    @endsection
