
@extends("layouts.master") @section('title') Bikeshop | อุปกรณ์จักรยาน,อะไหล่,ชุดแข่งและอุปกรณ์ตกแต่ง@stop @section('content')
{{-- แสดงผลทุกอย่างอยู่ภายใต้ div ของ algular --}}
<div class="container test" ng-app="app" ng-controller="ctrl">

    <br>
    <br>

    <input type="text" class="form-control" ng-model="query.name" placeholder="ค้นหา">

    <br>
    <br> 
    <div class="row">
        <div class="col-md-3">
            <h1 style="matgin: 0 0 30px 0">สินค้าในร้าน</h1>
        </div>
        <div class="col-md-9">
            <div class="pull-right" style="margin-top:10px">
                <input type="text" class="form-control" ng-model="query" ng-keyup="searchProduct($event)" style="width:190px" placeholder="พิมชื่อสินค้าเพื่อค้นหา">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item" ng-class="{'active': category == null}" ng-click="getProductList(null)">ทั้งหมด</a>
                <a href="#" class="list-group-item" ng-repeat="c in categories" ng-click="getProductList(c)" ng-class="{'active': category.id == c.id}">@{c.name}</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products">
                    {{-- start --}}
                    <div class="panel panel-default bs-product-card">
                        <img ng-src="@{p.image_url}" class="">
                        <div class="panel-body">
                            <h4>
                                <a href="#">@{p.name}</a>
                            </h4>
                            <div class="form-group">
                                <div>คงเหลือ:@{p.stock_qty}</div>
                                <div>ราคา
                                    <strong>@{p.price}</strong>บาท</div>
                            </div>
                            <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)">
                                <i class="fa fa-shopping-cart"></i>หยิบใส่ตะกร้า</a>
                        </div>
                        
                    </div>
                    {{-- end --}}
                </div>
            </div>
        </div>
        <h3 ng-if="!products.length">ไม่พบข้อมูลสินค้า</h3>
    </div>
</div>



<script type="text/javascript">
    var app = angular.module('app', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('@{').endSymbol('}');
    });

    app.service('productService', function ($http) {
        this.searchProduct = function (query){
            return $http({
                url: '/api/product/search',
                method: 'post',
                data: {'query' : query},
            });
        }
        this.getProductList = function (category_id) {
            if (category_id) {
                return $http.get('/api/product/' + category_id);
            }
            return $http.get('api/product');
        };
        this.getCategoryList = function () {
            return $http.get('/api/category');
        };

    });

    app.controller('ctrl', function ($scope, productService) {
        // $scope.products = [
        //     {'code': 'P001','name': 'ชุดแข่งสินค้า Size L', 'price': 1500.00, 'qty': 6},
        //     {'code': 'P002','name': 'หมวกกันน้อครุ่น SM-200', 'price': 1400.00, 'qty': 0},
        //     {'code': 'P003','name': 'มิเตอร์วัดความเร็ว', 'price': 1450.00, 'qty': 2},
        // ];
        $scope.searchProduct = function(e){
            productService.searchProduct($scope.query).then(function (res){
                if (!res.data.ok)
                    return;
                $scope.products = res.data.products;
            });
        };
        $scope.categories = {};
        $scope.getProductList = function (category) {
            $scope.category = category;
            category_id = category != null ? category.id : '';

            productService.getProductList(category_id).then(function (res) {
                console.log(res);
                if (!res.data.ok)
                    return;
                $scope.products = res.data.products;
            });
        };

        $scope.getProductList(null);

        // $scope.categories = [];
        $scope.getCategoryList = function () {
            productService.getCategoryList().then(function (res) {
                console.log(res);
                if (!res.data.ok)
                    return;
                $scope.categories = res.data.categories;
            });
        };

        $scope.getCategoryList();

        $scope.addToCart = function (p){
            window.location.href = '/cart/add/'+p.id;
        };
    });

    //สร้างservice

</script> @endsection