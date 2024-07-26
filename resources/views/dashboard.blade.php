@inject('users', 'App\Models\User')
{{-- @inject('restaurants', 'App\Models\Restaurant') --}}
@inject('products', 'App\Models\Product')
{{-- @inject('clients', 'App\Models\Client') --}}
@inject('categories', 'App\Models\Category')
@inject('orders', 'App\Models\Order')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @section('title')
        الرئيسيه
    @endsection
    @include('layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0">لوحة التحكم</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">المنتجات</p>
                                    <h4>{{ $products->count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                                <a href="{{ route('admin.products.index') }}">المزيد</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fas fa-users highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">المستخدمين</p>
                                    <h4>{{ $users->count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                                <a href="{{ route('admin.users.index') }}">المزيد</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fa fa-shopping-cart highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">الطلبات</p>
                                    <h4>{{ $orders->count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                                <a href="{{ route('admin.orders.index') }}">المزيد</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">الاقسام</p>
                                    <h4>{{ $categories->count() }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                                <a href="{{ route('admin.categories.index') }}">المزيد</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->
            <div class="row">
                <div style="min-height: 400px;" class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">
                                            اخر العمليات علي النظام
                                        </h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                    href="#students" role="tab" aria-controls="students"
                                                    aria-selected="true">المنتجات</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="teachers-tab" data-toggle="tab"
                                                    href="#teachers" role="tab" aria-controls="teachers"
                                                    aria-selected="false">المستخدمين
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="parents-tab" data-toggle="tab"
                                                    href="#parents" role="tab" aria-controls="parents"
                                                    aria-selected="false">الطلبات
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade active show" id="students" role="tabpanel"
                                        aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-dark text-white">
                                                        <th>#</th>
                                                        <th>اسم المنتج</th>
                                                        <th>القسم</th>
                                                        <th>السعر</th>
                                                        <th>الصوره</th>
                                                        <th>الوصف</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($products->latest()->paginate(5) as $product)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->category->name }}</td>
                                                            <td>{{ $product->price }}</td>
                                                            <td>
                                                                @if ($product->images->count())
                                                                    <img src="{{ $product->images[0]->url }}"
                                                                        alt=""
                                                                        style="width:50px;height:50px;">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $product->description }}
                                                            </td>
                                                        @empty
                                                            <td colspan="8">
                                                                <h4 class="text-danger">
                                                                    لا يوجد بيانات
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="teachers" role="tabpanel"
                                        aria-labelledby="teachers-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                    <tr class="table-dark text-white">
                                                        <th>#</th>
                                                        <th>اسم المستخدم</th>
                                                        <th>البريد الالكتروني</th>
                                                        <th>الهاتف</th>
                                                        <th>الصوره</th>
                                                    </tr>
                                                </thead>
                                                @forelse($users->orderBy('id','DESC')->paginate(5) as $user)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>
                                                                <img style="height:50px;width:50px"
                                                                    src="{{ $user->image }}" alt="....">
                                                            </td>
                                                        @empty
                                                            <td colspan="8">
                                                                <h4 class="text-danger">
                                                                    لا يوجد بيانات
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="parents" role="tabpanel"
                                        aria-labelledby="parents-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center"
                                                class="table center-aligned-table table-hover mb-0">

                                                <thead>
                                                    <tr class="table-dark text-white">
                                                        <th>#</th>
                                                        <th>المستخدم</th>
                                                        <th>الهاتف</th>
                                                        <th>التكلفه</th>
                                                        <th>الخصم</th>
                                                        <th>الاجمالي</th>
                                                        <th>الحاله</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($orders->latest()->paginate(5) as $order)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $order->user->name }}</td>
                                                            <td>{{ $order->phone }}</td>
                                                            <td>{{ $order->subtotal }} </td>
                                                            <td>{{ $order->discount }}</td>
                                                            <td>{{ $order->total }}</td>
                                                            <td>
                                                                <p class="badge bg-success text-white">
                                                                    {{ $order->status->order() }}</p>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                                    class="btn btn-warning btn-sm text-white"
                                                                    title="عرض"><i class="fas fa-eye"></i></a>
                                                            </td>
                                                        @empty
                                                            <td colspan="8">
                                                                <h4 class="text-danger">
                                                                    لا يوجد بيانات
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

</body>

</html>
