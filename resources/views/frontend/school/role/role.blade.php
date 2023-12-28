@extends('layouts.school.master')
@section('content')

<main class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="box-shadow:4px 3px 13px  .13px #484748  !important;">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">{{__('app.Class')}} {{__('app.Show')}}</h5>
                        <div class="ms-auto">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table text-center" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th width="10%">{{__('app.nong')}}</th>
                                    <th>{{__('app.role_name')}}</th>
                                    <th width="25%">{{__('app.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key=>$role)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="permissionMOdal('{{$role->id}}')" data-bs-target="#exampleModal" data-bs-toggle="modal">Permission</button>
                                            
                                        <button type="button" class="btn-primary btn-sm" title="{{__('app.Edit')}}" data-bs-toggle="modal" data-bs-target="#editModal{{ $role->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn-danger btn-sm" title="{{__('app.Delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}"><i class="bi bi-trash-fill"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <div id="permissionForm"></div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection


    @push('js')
    <script>
        function permissionMOdal(id) {
            
            $.ajax({
                url: '/school/permission/' + id,
                type: 'GET',
                success: function(data) {
                    $('#permissionForm').html(data);
                },
                error: function(error) {
                    alert('Failed to load  form');
                    console.log(error);
                }
            });


        }
    </script>
    @endpush