@extends('layouts.master')
@section('title')
    الاعدادات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">الاعدادات</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="default-color">الرئيسيه</a></li>
                    <li class="breadcrumb-item active">الاعدادات</li>
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
                    <form action="{{ route('admin.settings.update', $setting->id) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="title">الهاتف</label>
                                <input type="text" name="phone" class="form-control" value="{{ $setting->phone }}">
                            </div>
                            <div class="col">
                                <label for="title">البريد الالكتروني</label>
                                <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">عن المتجر 1 <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="text1" id="exampleFormControlTextarea1" rows="4">{{ $setting->text1 }}</textarea>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="t_link">صوره الاسكرينه 1</label>
                                <input type="file" name="image1" class="form-control">
                                <img style="width: 100px;height:100px" src="{{ $setting->image1 }}" alt="........"
                                    srcset="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">عن المتجر 2 <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="text2" id="exampleFormControlTextarea1" rows="4">{{ $setting->text2 }}</textarea>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="t_link">صوره الاسكرينه 2</label>
                                <input type="file" name="image2" class="form-control">
                                <img style="width: 100px;height:100px" src="{{ $setting->image2 }}" alt="........"
                                    srcset="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">عن المتجر 3 <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="text3" id="exampleFormControlTextarea1" rows="4">{{ $setting->text3 }}</textarea>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="t_link">صوره الاسكرينه 3</label>
                                <input type="file" name="image3" class="form-control">
                                <img style="width: 100px;height:100px" src="{{ $setting->image3 }}" alt="........"
                                    srcset="">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="f_link">لينك الفيس بوك</label>
                                <input type="text" name="f_link" class="form-control" value="{{ $setting->f_link }}">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="i_link">لينك الانستجرام</label>
                                <input type="text" name="i_link" class="form-control" value="{{ $setting->i_link }}">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="t_link">لينك تويتر</label>
                                <input type="text" name="t_link" class="form-control" value="{{ $setting->t_link }}">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">سياسة الخصوصيه <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="conditions" id="exampleFormControlTextarea1" rows="4">{{ $setting->conditions }}</textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">الشروط والاحكام<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="policy" id="exampleFormControlTextarea1" rows="4">{{ $setting->policy }}</textarea>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="t_link">الشعار</label>
                                <input type="file" name="logo" class="form-control">
                                <img style="width: 100px;height:100px" src="{{ $setting->logo }}" alt="........"
                                    srcset="">
                            </div>
                        </div>
                        <br>



                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">تحديث</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@endsection
