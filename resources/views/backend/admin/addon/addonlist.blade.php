@extends('layouts.master')

@section('content')
    <style>
        .modal-lg {
            max-width: 1140px;
        }

        .bi-toggle-on {
            color: rgb(6, 212, 6);
        }

        .bi-toggle-off {
            color: rgb(6, 212, 6);
        }
    </style>
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
                                <strong>List</strong>
                            </li>
                        </ol>
                    </div>

                </div>

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <h1><strong>Addon List</strong></h1>
                            </center>
                            <div class="row mb-2">
                                <div class="col-6 ">
                                    <a href="{{ route('Addon.form') }}" class="btn btn-primary">Create</a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#featureModal">
                                        Feature List
                                    </button>
                                </div>
                            </div>

                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-lg-12">
                            <div class="ibox ">

                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example"
                                            class="text-center">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>title</th>
                                                    <th>Feature Name</th>
                                                    <th>Image</th>
                                                    <th>Price</th>
                                                    <th>Short Description</th>
                                                    <th>Long Description</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($addons as $key => $addon)
                                                    <tr class="text-center">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $addon->title }}</td>
                                                        <td>{{ App\Models\FeatureList::find($addon->feature_id)?->name }}
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset($addon->image ?? 'd/no-img.jpg') }}"
                                                                alt="" width="60" height="40">
                                                        </td>
                                                        <td>{{ $addon->price }}</td>
                                                        <td>{{ Str::limit($addon->description, 10) }}</td>
                                                        <td>{!! Str::limit($addon->longdescription, 20) !!}</td>
                                                        <td>
                                                            @if ($addon->button == 0)
                                                                <button class="btn btn-success btn-sm">Free</button>
                                                            @else
                                                                <button class="btn btn-info btn-sm">Perchase</button>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($addon->status == 1)
                                                                <a href="{{ route('Addon.status', $addon->id) }}"
                                                                    style="font-size:22px"><i
                                                                        class="bi bi-toggle-on"></i></a>
                                                            @else
                                                                <a href="{{ route('Addon.status', $addon->id) }}"
                                                                    style="font-size:22px"><i
                                                                        class="bi bi-toggle-off"></i></a>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ route('Addon.Edit', $addon->id) }}" onclick=""
                                                                class="btn btn-primary"><i class="bi bi-pencil-square"></i>
                                                            </a>

                                                            <a href="javascript::"
                                                                onclick="if(confirm('Are your sure? Do you want to delete?')){ location.replace('{{ route('Addon.Delete', $addon->id) }}') }"
                                                                class="btn btn-danger"><i class="bi bi-trash3"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <h1>Addon Subscribe School list</h1>
                            </center>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-lg-12">
                            <div class="ibox ">

                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example"
                                            class="text-center">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>School</th>
                                                    <th>Addon</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($paidaddons as $key => $addon)
                                                    <tr class="text-center">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ App\Models\School::find($addon->school_id)?->school_name }}
                                                        </td>
                                                        <td>{{ App\Models\Addonmodel::find($addon->addon_id)?->title }}
                                                        </td>
                                                        <td>{{ $addon->price }}</td>
                                                        <td>
                                                            @if ($addon->status == 0)
                                                                <a href="{{ route('addon.purchase.status', $addon->id) }}"
                                                                    style="font-size:22px"><i
                                                                        class="bi bi-file-earmark-lock2"></i></a>
                                                            @elseif ($addon->status == 1)
                                                                <a href="{{ route('addon.purchase.status', $addon->id) }}"
                                                                    style="font-size:22px"><i
                                                                        class="bi bi-toggle-on"></i></a>
                                                            @else
                                                                <a href="{{ route('addon.purchase.status', $addon->id) }}"
                                                                    style="font-size:22px"><i
                                                                        class="bi bi-toggle-off"></i></a>
                                                            @endif

                                                        </td>
                                                        {{-- <td>
                                                            <a href="{{ route('Addon.Edit', $addon->id) }}" onclick=""
                                                                class="btn btn-primary"><i class="bi bi-pencil-square"></i>
                                                            </a>

                                                            <a href="javascript::"
                                                                onclick="if(confirm('Are your sure? Do you want to delete?')){ location.replace('{{ route('Addon.Delete', $addon->id) }}') }"
                                                                class="btn btn-danger"><i class="bi bi-trash3"></i>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
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

        <script>
            // When the user clicks on <div>, open the popup
            function myFunction() {
                var popup = document.getElementById("myPopup");
                popup.classList.toggle("show");
            }
        </script>


        <!--Feature list Modal -->

        <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title text-center" id="exampleModalLabel">Feature List</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features->where('id', '<=', '21') as $feature)
                                            <tr>
                                                <th scope="row">{{ $feature->id }}</th>
                                                <td>{{ $feature->name }}</td>
                                                <td>
                                                    @if ($feature->status == 1)
                                                        <a href="{{ route('feature.status', $feature->id) }}"
                                                            style="font-size:22px"><i class="bi bi-toggle-on"></i></a>
                                                    @else
                                                        <a href="{{ route('feature.status', $feature->id) }}"
                                                            style="font-size:22px"><i class="bi bi-toggle-off"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features->where('id', '>', '21')->where('id', '<=', '42') as $feature)
                                            <tr>
                                                <th scope="row">{{ $feature->id }}</th>
                                                <td>{{ $feature->name }}</td>
                                                <td>
                                                    @if ($feature->status == 1)
                                                        <a href="{{ route('feature.status', $feature->id) }}"
                                                            style="font-size:22px"><i class="bi bi-toggle-on"></i></a>
                                                    @else
                                                        <a href="{{ route('feature.status', $feature->id) }}"
                                                            style="font-size:22px"><i class="bi bi-toggle-off"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features->where('id', '>', '42') as $feature)
                                            <tr>
                                                <th scope="row">{{ $feature->id }}</th>
                                                <td>{{ $feature->name }}</td>
                                                <td>
                                                    @if ($feature->status == 1)
                                                        <a href="{{ route('feature.status', $feature->id) }}"
                                                            style="font-size:22px"><i class="bi bi-toggle-on"></i></a>
                                                    @else
                                                        <a href="{{ route('feature.status', $feature->id) }}"
                                                            style="font-size:22px"><i class="bi bi-toggle-off"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
