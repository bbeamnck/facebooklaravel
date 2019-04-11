@extends('layouts.master') @section('title') BikeShop | รายงาน @stop @section('content')

<div class="container">
    <h1>รายงาน</h1>

    <ul class="breadcrumb">
        <li>
            <a href="{{ URL::to('product') }}"> หน้าแรก</a>
        </li>
        <li class="active">รายงาน</li>
    </ul>
    {{-- กราฟแท่ง --}}
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>มูลค่าสินค้า</strong>
                    </div>
                </div>
                <div class="panel-body">
                    <canvas id="myBarChart" height="100"></canvas>
                    <script type="text/javascript">
                        $.get("/api/product/chart/list", function (response) {
                            console.log(response);
                            var ctx = document.getElementById("myBarChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: response.product_names,
                                    datasets: [{
                                        data: response.product_prices,
                                        backgroundColor: [
                                            'rgba(255,99,132,0.2)',
                                            'rgba(54,162,235,0.2)',
                                            'rgba(255,206,86,0.2)',
                                            'rgba(75,192,192,0.2)',
                                            'rgba(153,102,255,0.2)',
                                            'rgba(155,159,64,0.2)',
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(255,99,132,1)',
                                            'rgba(255,99,132,1)',
                                            'rgba(255,99,132,1)',
                                            'rgba(255,99,132,1)',
                                            'rgba(255,99,132,1)',
                                        ],
                                        label: '# of Votes',
                                    }]
                                },
                                options: { scales: { yAxes: [{ ticks: { beginAtZero: true } }] } }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        {{-- วงกลม --}}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>มูลค่าสินค้าแยกตามประเภท</strong>
                    </div>
                </div>

                <div class="panel-body">
                    <canvas id="myPieChart" height="100"></canvas>
                    <script type="text/javascript">
                        $.get("/api/category/chart/list", function (response) {
                            console.log(response);
                            var ctx = document.getElementById("myPieChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    datasets: [{
                                        data: response.cat_prices,
                                        backgroundColor: [
                                            'rgba(255,99,132,0.2)',
                                            'rgba(54,162,235,0.2)',
                                            'rgba(255,206,86,0.2)',
                                        ],


                                    }],
                                    labels: response.cat_names,
                                },
                            });
                        });

                        // var ctx = document.getElementById("myPieChart").getContext('2d');
                        // var myPieChart = new Chart(ctx, {
                        //     type: 'pie',
                        //     data: {

                        //         datasets: [{
                        //             data: [10,20,30],
                        //             backgroundColor: [
                        //             'rgba(255,99,132,0.2)',
                        //             'rgba(54,162,235,0.2)',
                        //             'rgba(255,206,86,0.2)',
                        //             ],
                        //         }],
                        //         labels: ["ประเภท 1" , "ประเภท 2" , "ประเภท 3"],
                        //     },
                        // });
                    </script>
                </div>
            </div>
        </div>
    </div>

    {{-- ส่วนพิมโชว์ --}}
    <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>มูลค่าสินค้า</strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <canvas id="myBarChart1" height="100"></canvas>
                        <script type="text/javascript">
                        var ctx = document.getElementById("myBarChart1").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ["สินค้า 1" , "สินค้า 2" , "สินค้า 3" , "สินค้า 4" , "สินค้า 5" ,"สินค้า 6"],
                                datasets: [{
                                    backgroundColor: [
                                        'rgba(255,99,132,0.2)',
                                        'rgba(54,162,235,0.2)',
                                        'rgba(255,206,86,0.2)',
                                        'rgba(75,192,192,0.2)',
                                        'rgba(153,102,255,0.2)',
                                        'rgba(155,159,64,0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255,99,132,1)',
                                        'rgba(255,99,132,1)',
                                        'rgba(255,99,132,1)',
                                        'rgba(255,99,132,1)',
                                        'rgba(255,99,132,1)',
                                        'rgba(255,99,132,1)',
                                    ],
                                    label: '# of Votes',
                                    data: [12,19,3,5,2,3]
                                }]
                            },
                            options: { scales: { yAxes: [{ ticks: { beginAtZero:true } }] }}
                        });
                        </script>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <strong>มูลค่าสินค้าแยกตามประเภท</strong>
                                </div>
                            </div>
            
                            <div class="panel-body">
                                <canvas id="myPieChart1" height="100"></canvas>
                                <script type="text/javascript">
                                    var ctx = document.getElementById("myPieChart1").getContext('2d');
                                    var myPieChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
            
                                            datasets: [{
                                                data: [10,20,30],
                                                backgroundColor: [
                                                'rgba(255,99,132,0.2)',
                                                'rgba(54,162,235,0.2)',
                                                'rgba(255,206,86,0.2)',
                                                ],
                                            }],
                                            labels: ["ประเภท 1" , "ประเภท 2" , "ประเภท 3"],
                                        },
                                    });
                                </script>
                            </div>
                        </div>
            </div>
    </div>



    @endsection