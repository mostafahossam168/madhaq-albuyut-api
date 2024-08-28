@extends('layouts.master')
@section('title')
    تعديل اسرة
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> تعديل اسرة</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="default-color">الرئيسيه</a></li>
                    <li class="breadcrumb-item active"> تعديل اسرة</li>
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
                    <form action="{{ route('admin.families.update', $family->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col">
                                <label for="title">اسم الاسرة</label>
                                <input type="text" name="name" class="form-control" value="{{ $family->name }}">
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">وصف الاسرة<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="10">{{ $family->description }}</textarea>
                            @error('description')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="image">صوره الاسرة</label>
                                <input type="file" accept="image/*" name="image" class="form-control" value="">
                                @error('image')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div>
                                    <img src="{{ asset($family->image) }}" alt="" style="width: 60px;height:60px">
                                </div>
                            </div>
                        </div>

                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">تعديل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- row closed -->
@endsection
@section('js')
@endsection
