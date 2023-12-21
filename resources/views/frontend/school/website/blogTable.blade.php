@extends('layouts.school.master')

@section('content')
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h3><b>Weblite Setting</b></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3 bg-transparent">
            <div class="d-sm-flex">
                <h5 class="mb-2 mb-sm-0">Blog List</h5>
                <div class="ms-auto">
                    <button type="button" class="btn btn-secondary" onclick="history.back()"><i class="bi bi-arrow-left-square"> {{__('app.back')}}</i></button>

                    <a href="{{route('school.website.blog')}}" class="btn btn-primary"><i class="bi bi-plus-square"></i> Create</a>

                </div>
            </div>
        </div>

            <div class="table-responsive">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th >Details</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $key=>$blog)
                        <tr>
                            <td><img src="{{$blog->image}}" style="padding:5px;;" alt="img-01" width="120px;" height="120px;" /></td>
                            <td>{{ substr_replace(ucfirst($blog->title), '...', 50) }}</td>
                            <td>{{ substr_replace(ucfirst($blog->details), '...', 50) }}</td>
                            <td>{{date('d-m-Y',strtotime($blog->created_at))}}</td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#view{{$key}}" class="btn btn-danger btn-sm" title=""><i class="bi bi-eye"> </i></a>
                                <a href="{{ route('webBlog.edit', $blog->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pen-fill"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal{{$key}}" class="btn btn-danger btn-sm" title="{{__('app.delete')}}"><i class="bi bi-trash-fill"> </i></a>
                            </td>
                            <div class="modal fade" id="view{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">{{$blog->title}}
                                            </h6>
                                        </div>
                                        <div class="row" style="padding:5%;">
                                            <div class="col-md-5">
                                                <img src="{{$blog->image}}" alt="img-01" width="100%;" height="100%" />
                                            </div>
                                            <div class="col-md-7 p-10">{{$blog->details}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Class</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="get" action="{{route('webBlog.delete',$blog->id)}}">
                                            <div class="modal-body">
                                                Are you Sure To Delete ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</main>

@endsection