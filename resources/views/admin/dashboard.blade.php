@extends('admin.layouts.menu')
@section('name_page', 'สรุปข้อมูลโดยรวม')
@section('content')
<div class="row">
    <div class="col-xl-3 col-md6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
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
<div class="card mb-3">
    <div class="card-header">สินค้าขายดี 10 อันดับ</div>
    <div class="card-body">
        <canvas id="barChart"></canvas>
    </div>
</div>
<div class="card">
    <div class="card-header">กราฟแสดงจำนวนรูปแบบการผ่อน</div>
    <div class="card-body">
        <canvas id="pieChart"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script>
$(function () {
    getProductChart();
    getInstallmentTypeChart();
});
function getProductChart() {
    $.ajax({
        type: "GET",
        url: "{{route('api.chart.getProductChart')}}",
        success: function (response) {
            // console.log(response);
            setupChart(response.datas);
        }
    });
}
function setupChart(items) {
    let labels = [];
    let datasets = [];
    let colors = [];
    items.forEach(item => {
        labels.push(item.name_en);
        datasets.push(`${item.product_count}`);
        let color = getRandomColor();
        colors.push(color);
    });

    const data = {
        labels: labels,
        datasets: [{
            label: 'จำนวน',
            data: datasets,
            backgroundColor: colors
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 1,
                        beginAtZero: true
                    }
                }]
            }
        }
    };

    new Chart(
        document.getElementById('barChart'),
        config
    );
}
function getInstallmentTypeChart() {
    $.ajax({
        type: "GET",
        url: "{{route('api.chart.getInstallmentTypeChart')}}",
        success: function (response) {
            // console.log(response);
            setupInstallmentTypeChart(response.datas);
        }
    });
}
function setupInstallmentTypeChart(items) {
    let labels = [];
    let datasets = [];
    let colors = [];
    items.forEach(item => {
        labels.push(item.name);
        datasets.push(`${item.installment_type_count}`);
        let color = getRandomColor();
        colors.push(color);
    });

    const data = {
        labels: labels,
        datasets: [{
            label: 'จำนวน',
            data: datasets,
            backgroundColor: colors
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('pieChart'),
        config
    );
}
function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
</script>
@endpush

@push('css')

@endpush
