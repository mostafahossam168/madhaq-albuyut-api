@extends('layouts.master')
@section('title')
    اضافة منتج جديد
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">اضافة منتج جديد</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="default-color">الرئيسيه</a></li>
                    <li class="breadcrumb-item active">اضافة منتج جديد</li>
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
                    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="col">
                                <label for="title">اسم المنتج</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="category">القسم</label>
                                <select name="category_id" id="category" size="1" class="form-control form-white">
                                    <option value="" disabled selected>--حدد القسم --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="title">سعر المنتج</label>
                                <input type="number" name="price" step="any" class="form-control"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="col">
                                <label for="title">stock</label>
                                <input type="number" name="stock" step="any" class="form-control"
                                    value="{{ old('stock') }}">
                                @error('stock')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">وصف المنتج<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="image">صور المنتج</label>
                                <input type="file" accept="image/*" name="images[]" multiple class="form-control"
                                    value="">
                                @error('image')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="col">
                                <label for="images">صور المنتج</label>
                                <input type="file" name="images[]" multiple accept="image/*" class="form-control"
                                    value="">
                                @error('images')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}
                        <br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- row closed -->
@endsection
@section('js')
@endsection
