@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-md-12">

                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-md-10">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Admin</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <strong>Form</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('AddonList') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-content">

                                    <div class="row justify-content-center">
                                        <div class="col-md-6 b-r border">
                                            <center>
                                                <h2 class="m-t-none m-b">Addon Form </h2>
                                            </center>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (!isset($editAddon))
                                                <form action="{{ route('Addon.create') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <div class=" mb-3 ">
                                                            <input type="text" class="form-control input-sm"
                                                                name="title" required>
                                                            <p>The title must be at lss then 25 characters.</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Feature List</label>
                                                        <select name="feature_id" id=""
                                                            class="form-control input-sm" required>
                                                            @foreach ($features as $feature)
                                                                <option value="{{ $feature->id }}">{{ $feature->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <div class=" mb-3 ">
                                                            <input type="file" class="form-control" name="image"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <div class=" mb-3 ">
                                                            <input type="number" class="form-control input-sm"
                                                                name="price" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Button</label>
                                                        <div class="input-group mb-3">
                                                            <select name="button" id=""
                                                                class="form-control input-sm" required>
                                                                <option value="0">Free</option>
                                                                <option value="1">Purchase</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        {{-- <label>Status</label> --}}
                                                        <div class="input-group mb-3">
                                                            <input type="hidden" class="form-control input-sm"
                                                                name="status" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Short Description</label>
                                                        <strong>The description must be at 185-190 characters.</strong>
                                                        <div class="input-group mb-3">
                                                            <textarea name="description" id="" cols="20" rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Long Description</label>
                                                        <div class="input-group mb-3">
                                                            <textarea name="longdescription" id="summernote" cols="30" rows="10" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-sm btn-primary mb-5" type="submit">
                                                            <strong>Create</strong>
                                                        </button>
                                                    </div>

                                        </div>
                                        </form>
                                    @else
                                        <form action="{{ route('Addon.Update', $editAddon->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label>Title</label>
                                                <div class=" mb-3 ">
                                                    <input value="{{ $editAddon->title }}" type="text"
                                                        class="form-control input-sm" name="title" required>
                                                    <p>The title must be at less then 25 characters.</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class=" mb-3 ">
                                                    <input value="{{ $editAddon->image }}" type="file"
                                                        class="form-control" name="image">
                                                    <img src="{{ asset($editAddon->image ?? 'd/no-img.jpg') }}"
                                                        alt="" width="120" height="80">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <div class=" mb-3 ">
                                                    <input value="{{ $editAddon->price }}" type="number"
                                                        class="form-control input-sm" name="price" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Button</label>
                                                <div class="input-group mb-3">
                                                    <select name="button" id="" class="form-control input-sm"
                                                        required>
                                                        <option value="0"
                                                            {{ $editAddon->button == 0 ? 'selected' : '' }}>
                                                            Free</option>
                                                        <option value="1"
                                                            {{ $editAddon->button == 1 ? 'selected' : '' }}>
                                                            Purchase</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label>Status</label>
                                                <div class="input-group mb-3">
                                                    <select name="status" id="" class="form-control input-sm"
                                                        required>
                                                        <option value="0"
                                                            {{ $editAddon->status == 0 ? 'selected' : '' }}>Inactive
                                                        </option>
                                                        <option value="1"
                                                            {{ $editAddon->status == 1 ? 'selected' : '' }}>Active</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <strong>The description must be at 185-190 characters.</strong>
                                                <div class="input-group mb-3">
                                                    <textarea name="description" id="" cols="30" rows="5" class="form-control" value="">{!! $editAddon->description !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Long Description</label>
                                                <div class="input-group mb-3">
                                                    <textarea name="longdescription" id="summernote" cols="30" rows="10" class="form-control"
                                                        value="">{!! $editAddon->longdescription !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-sm btn-primary mb-5" type="submit">
                                                    <strong>Update</strong>
                                                </button>
                                            </div>

                                    </div>
                                    </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
