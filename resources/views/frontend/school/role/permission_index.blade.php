@extends('layouts.school.master')

@section('content')
@push('cs')
<style>

</style>
@endpush
<!--start content-->
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="box-shadow:4px 3px 13px  .13px #484748  !important;">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">Permission Show</h5>
                        <div class="ms-auto">
                            <button type="button" title="{{__('app.Back')}}" class="btn-secondary btn-sm" onclick="history.back()"><i class="bi bi-arrow-left-square"></i></button>
                            <a href="{{route('permission.create')}}" title="Permission Create" class="btn btn-primary btn-sm"><i class="bi bi-plus-square m-0"></i></a>
                            <button type="button" title="{{__('app.Tutorial')}}" class="btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="lni lni-youtube"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table text-center" style="width:100%">
                            
                            <thead class="text-center">
                                <tr>
                                    <th><input type="checkbox" id="select_all_id" title="Select"></th>
                                    <th>{{__('app.nong')}}</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>{{__('app.role_name')}}</th>
                                    <th>{{__('app.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($permissions as $key => $permission)
                                    <tr id="permission_all_id{{ $permission->id }}">
                                        <td><input type="checkbox" class="check_id" name="permission_id" value="{{ $permission->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $permission->teacher->full_name}}</td>
                                        <td>{{ $permission->teacher->email}}</td>
                                        <td><span class="badge rounded-pill bg-success">{{ $permission->role->role_name }}</span></td>
                                        {{-- <td>{{($data->active == 1) ? 'ON' : 'OFF'}}</td> --}}
                                        <td>
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <a href="{{ route('permission.edit', $permission->id) }}">
                                                    <button type="button" class="btn btn-primary btn-sm" title="{{__('app.Edit')}}"><i class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" title="{{__('app.Delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $permission->id }}"><i class="bi bi-trash-fill"></i></button>
                                            </div>
                                        </td>

                                        <div class="modal fade" id="deleteModal{{ $permission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:blueviolet;">
                                                        <h4 class="modal-title text-white" id="exampleModalLabel">{{__('app.Delete')}} Permission</h4>
                                                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="get" action="{{route('permission.delete', $permission->id)}}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <h5>{{__('app.surecall')}} ?</h5>
                                                            <h6 style="color: red;">You will lost Teacher's Role Permission</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('app.no')}}</button>
                                                            <button type="submit" class="btn btn-primary btn-sm">{{__('app.yes')}}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="row" style="margin-top: -35px;margin-bottom: 10px;">
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#delete_all_records">
                                    {{__('app.deleteall')}}
                                </button>
                                <button type="button" onclick="printDiv()" class="btn btn-primary btn-sm  ms-2 ">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- delete checkbox Modal -->
<div class="modal fade" id="delete_all_records" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:blueviolet;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">{{__('app.class')}} {{__('app.Record')}}</h4>
                <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>
                    {{__('app.checkdelete')}}
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('app.no')}}</button>
                <button type="button" class="btn btn-primary  btn-sm" id="all_delete">{{__('app.yes')}}</button>
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
        $("#select_all_id").click(function() {
            $('.check_id').prop('checked', $(this).prop('checked'));
        });

        $("#all_delete").click(function(e) {
            e.preventDefault();
            var permissions = [];
            $('input:checkbox[name=permission_id]:checked').each(function() {
                permissions.push($(this).val());
            });

            $.ajax({
                url: "{{route('permission.all.delete')}}",
                type: "DELETE",
                data: {
                    permissions: permissions,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#permission_all_id' + val).remove();
                        // window.location.reload(true);
                    });
                }
            });
        });
    });
</script>
@endpush