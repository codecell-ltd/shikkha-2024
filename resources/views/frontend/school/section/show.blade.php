@extends('layouts.school.master')

@section('content')
<!--start content-->
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">{{__('app.Section')}}</h5>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-secondary btn-sm" title="{{__('app.Back')}}" onclick="history.back()"><i class="bi bi-arrow-left-square m-0"> Back</i></button>
                            @if (hasPermission("section_create"))
                                <a href="{{route('section.create')}}" class="btn btn-primary btn-sm" title="{{__('app.Section')}} {{__('app.Create')}}"><i class="bi bi-plus-square m-0"> Create</i></a>
                            @endif
                            {{-- <button type="button" class="btn btn-danger btn-sm" title="{{__('app.Tutorial')}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="lni lni-youtube m-0"> Tutorial</i></button> --}}
                        </div>
                    </div>
                </div>

                @php
                    $class = \App\Models\InstituteClass::orderby('id','asc')->where('school_id',authUser()->id)->get();
                @endphp

                @if (count($class) > 0)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{__('app.nong')}}</th>
                                        <th>{{__('app.Class')}} {{__('app.Name')}}</th>
                                        <th>{{__('app.Section')}} {{__('app.Name')}}</th>
                                    </tr>
                                    <tr>
                                        @foreach(\App\Models\InstituteClass::orderby('id','asc')->where('school_id',authUser()->id)->get() as $key =>$class)
                                        <td class="col-md-2 align-middle">{{$key++ +1}}</td>
                                        <td class="col-md-2 align-middle">{{$class->class_name}}</td>
                                        <td class="col-md-8">
                                            <table class="table table-striped table-bordered">
                                                @foreach(\App\Models\Section::where('class_id',$class->id)->get() as $data)
                                                <tr>
                                                    {{-- <td>{{$data->section_name}}
                                        </td> --}}
                                        <td class="col-md-6 align-middle">{{$data->section_name}}</td>
                                        <td class="col-md-2 align-middle">
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                @if (hasPermission("section_edit"))
                                                    <button type="button" class="btn btn-primary btn-sm" title="{{__('app.Delete')}}" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}"><i class="bi bi-pencil-square"></i></button>
                                                @endif
                                                @if (hasPermission("section_delete"))
                                                    <button type="button" class="btn btn-danger btn-sm" title="{{__('app.Delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}"><i class="bi bi-trash-fill"></i></button>
                                                @endif
                                            </div>
                                        </td>
                                        <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:blueviolet;">
                                                        <h4 class="modal-title text-white" id="exampleModalLabel">{{__('app.Delete')}} {{__('app.section')}}</h4>
                                                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="get" action="{{route('section.delete',$data->id)}}">
                                                        <div class="modal-body">
                                                            <h5>{{__('app.surecall')}} ?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('app.no')}}</button>
                                                            <button type="submit" class="btn btn-primary btn-sm">{{__('app.yes')}}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:blueviolet;">
                                                        <h4 class="modal-title text-white" id="exampleModalLabel">{{__('app.Edit')}} {{__('app.Section')}}</h4>
                                                        <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body border  mt-4 mb-4 ms-4 me-4">

                                                        <form class="row g-3 p-3 " method="post" action="{{route('section.update.post',$data->id)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-12">
                                                                <label class="select-form">Class Name <span style="color: red;"> *</span></label>
                                                                <select class="form-control mb-3 js-select" aria-label="Default select example" name="class_id">
                                                                    <option value="{{$data?->class_id}}" selected>{{getClassName($data->class_id)?->class_name}}</option>
                                                                    @foreach($class as $value)
                                                                        {{-- <option value="{{$value->id}}">{{$value->class_name}}</option> --}}
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="col-12 mt-4">
                                                                <label class="form-label">Section Name <span style="color: red;"> *</span></label>
                                                                    <input type="text" required class="form-control" placeholder="Section name" name="section_name" value="{{$data->section_name}}">
                                                                
                                                            </div>

                                                            <div class="col-12 mt-4">
                                                                <div class="d-grid">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                    @endforeach
                            </table>
                            </td>
                            </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>                    
                @else
                    <center>
                        <div class="card">
                            <div class="card-body mb-3">
                                <img src="{{asset('images/no_data_found.svg')}}" alt="" width="200px;" height="200px;" srcset="">                                        
                            </div>  
                            <div class="text-muted">
                                <h5 style="padding: 0px;">No Data Found.</h5>
                            </div>

                        </div>                            
                    </center>
                @endif
                
            </div>
        </div>
    </div>
</main>

<?php
$tutorialShow = getTutorial('section-show');
?>
@include('frontend.partials.tutorial')
@endsection