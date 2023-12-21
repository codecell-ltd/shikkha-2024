@extends('layouts.school.master')

@section('content')
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="box-shadow:4px 3px 13px  .13px #484748  !important;">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">Role Show</h5>
                        <div class="ms-auto">
                            <button type="button" title="{{__('app.Back')}}" class="btn-secondary btn-sm" onclick="history.back()"><i class="bi bi-arrow-left-square"></i> Back</button>
                            <button type="button" title="Role Create" data-bs-toggle="modal" data-bs-target="#createRoleModal" class="btn-primary btn-sm"><i class="bi bi-plus-square"></i> Create</button>
                            {{-- <button type="button" title="{{__('app.Tutorial')}}" class="btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="lni lni-youtube"></i></button> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table w-100">
                            <thead>
                                <tr>
                                    <th width="10%">{{__('app.nong')}}</th>
                                    <th>{{__('app.role_name')}}</th>
                                    <th width="25%">{{__('app.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                <tr id="class_ids{{ $role->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    {{-- <td>{{($data->active == 1) ? 'ON' : 'OFF'}}</td> --}}
                                    <td>

                                        <button type="button" class="btn-primary btn-sm" title="{{__('app.Edit')}}" data-bs-toggle="modal" data-bs-target="#editModal{{$key}}"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn-danger btn-sm" title="{{__('app.Delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}"><i class="bi bi-trash-fill"></i></button>
                                        <a type="button" href="" class="btn-sm btn-success" type="button" onclick="permissionMOdal('{{$role->id}}')" data-bs-target="#exampleModal" data-bs-toggle="modal">
                                            <i class="bi bi-shield-lock-fill"></i></a>
                                    </td>

                                    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:blueviolet;">
                                                    <h4 class="modal-title text-white" id="exampleModalLabel">{{__('app.Delete')}} {{__('app.Class')}}</h4>
                                                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="{{route('roles.destroy', $role->id)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-body">
                                                        <h5>{{__('app.surecall')}} ?</h5>
                                                        <h6 style="color: red;">You will lost Teacher's Permission</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('app.no')}}</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">{{__('app.yes')}}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="editModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:#9604d9;">
                                                    <h4 class="modal-title text-white" id="exampleModalLabel">Edit Role</h4>
                                                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body border ms-5 me-5 mt-5 mb-5">
                                                    <form class="row g-3 " method="post" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="col-12 mt-4">
                                                            <label class="form-label-edit">{{ __('app.role_name') }}</label>
                                                            <input type="text" required class="form-control" placeholder="Role" name="name" value="{{$role->name}}">
                                                        </div>
                                                        <div class="col-12 mt-4">
                                                            <div class="d-grid">
                                                                <button type="submit" class="btn btn-primary btn-sm">{{ __('app.Submit') }}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->



                                </tr>
                                @endforeach
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Permission Table</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-light">

                                                <div id="permissionForm"></div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- //Create Modal Box --}}
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#9604d9;">
                <h4 class="modal-title text-white" id="exampleModalLabel">Create Role</h4>
                <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <form class="row g-3" id="roleForm" method="post">
                    @csrf
                    <div class="col-12 mt-4">
                        <label class="form-label">Role Name <span style="color: red;">*</span></label>
                        <input type="text" placeholder="Enter role name" class="form-control" name="role_name" required>
                        @error('role_name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('app.Submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$tutorialShow = getTutorial('class-show');
?>
@include('frontend.partials.tutorial')
@endsection
@push('js')
<script>
    $(function(e) {
        $("#select_all_ids").click(function() {
            $('.check_ids').prop('checked', $(this).prop('checked'));
        });
        $("#all_delete").click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });
            console.log(all_ids);
            $.ajax({
                url: "{{route('class.Check.delete')}}",
                type: "DELETE",
                data: {
                    ids: all_ids,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#class_ids' + val).remove();
                        window.location.reload(true);
                    });
                }
            });
        });
    });
</script>

<script>
    function permissionMOdal(id) {

        var modal = document.getElementById("exampleModal");
        modal.style.display = "block";
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



    function openpermissionModal(event) {

        var formData = new FormData(document.getElementById("roleForm"));
        $.ajax({
            type: "POST",
            url: "/school/role",
            data: formData,
            success: function(response) {

            },
            error: function(error) {
                alert("Failed to create the role");

            }
        });

    }
</script>

@endpush