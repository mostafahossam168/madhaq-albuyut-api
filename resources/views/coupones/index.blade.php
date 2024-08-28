@extends('layouts.master')
@section('title')
    قائمة الخصومات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">قائمة الخصومات</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="default-color">الرئيسيه</a></li>
                    <li class="breadcrumb-item active">قائمة الخصومات</li>
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
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        اضافة خصم جديد
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الكود</th>
                                    <th>الخصم</th>
                                    <th>انتهاء الصلاحية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupones as $coupone)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $coupone->code }}</td>
                                        <td>{{ $coupone->discount }}</td>
                                        <td>{{ $coupone->expire_date }}</td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $coupone->id }}" title="تعديل"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $coupone->id }}" title="حذف"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $coupone->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تعديل الخصم
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('admin.coupones.update', $coupone->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('patch')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="Name" class="mr-sm-2">الكود
                                                                    :</label>
                                                                <input id="Name" type="text" name="code"
                                                                    class="form-control" value="{{ $coupone->code }}">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="Name" class="mr-sm-2">قيمة الخصم
                                                                    :</label>
                                                                <input id="Name" type="number" min="0"
                                                                    step="any" name="discount"
                                                                    value="{{ $coupone->discount }}" class="form-control">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="expire_date" class="mr-sm-2">انتهاء الصلاحية
                                                                    :</label>
                                                                <input id="expire_date" type="date" name="expire_date"
                                                                    class="form-control"
                                                                    value="{{ $coupone->expire_date }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-success">تعديل</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $coupone->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        حذف خصم
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.coupones.destroy', $coupone->id) }}"
                                                        method="post">
                                                        @method('Delete')
                                                        @csrf
                                                        هل انت متاكد من عملية حذف الخصم؟
                                                        <br>
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $coupone->id }}">
                                                        <input id="id" type="text" name="name" readonly
                                                            class="form-control" value="{{ $coupone->name }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                            <button type="submit" class="btn btn-danger">حذف</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            اضافة خصم
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('admin.coupones.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="Name" class="mr-sm-2">الكود
                                        :</label>
                                    <input id="Name" type="text" name="code" class="form-control"
                                        value="">
                                </div>
                                <div class="col-12">
                                    <label for="Name" class="mr-sm-2">قيمة الخصم
                                        :</label>
                                    <input id="Name" type="number" min="0" step="any" name="discount"
                                        class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="expire_date" class="mr-sm-2">انتهاء الصلاحية
                                        :</label>
                                    <input id="expire_date" type="date" name="expire_date" class="form-control">
                                </div>
                            </div>
                            <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
