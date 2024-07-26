@extends('layouts.master')
@section('title')
    قائمة الطلبات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">قائمة الطلبات</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="default-color">الرئيسيه</a></li>
                    <li class="breadcrumb-item active">قائمة الطلبات</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection





@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
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
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->subtotal }} </td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>
                                            <p class="badge bg-success text-white">{{ $order->status->order() }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="btn btn-warning btn-sm text-white" title="عرض"><i
                                                    class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
