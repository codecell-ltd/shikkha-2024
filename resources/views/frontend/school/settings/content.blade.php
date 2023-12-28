@extends('layouts.school.master')

@section('content')
    <!--start content-->
    <main class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl">
                        <div class="border p-3 rounded">
                            <h6 class="mb-0 text-uppercase">{{__('app.School')}} {{__('app.Setting')}}</h6>
                            <hr/>
                            <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    @include('frontend.layouts.message')
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h6>Result Setting (Mark Type): </h6>
                                        <div class="mb-3" style="padding-left: 30px;">
                                            {{-- <label class="form-label mb-5">{{__('app.Result')}} {{__('app.Setting')}}</label> --}}
                                            <input type="radio" class="" value="1" name="mark_type" {{ ($result_mark_setting == 1) ? 'checked' : ''  }}>
                                            <label class="form-check-label" for="mark_type">Default Mark Type</label> <br>
                                            <input type="radio" class="" value="2" name="mark_type" {{ ($result_mark_setting == 2) ? 'checked' : ''  }}>
                                            <label class="form-check-label" for="mark_type">Manual Mark Type</label> <br>
        
                                            @error('device_address')
                                                <span class="text-danger">
                                                    <strong> {{$message}} </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <button class="btn btn-primary">{{__('app.save')}}</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!--end row-->
    </main>

@endsection
