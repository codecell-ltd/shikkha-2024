@extends('layouts.school.master')

@section('content')

<main class="page-content">

    <div class="row">
        <div class="ms-auto mb-2">
            <button onclick="printDiv()" class="btn btn-primary btn-sm" title="{{__('app.Print')}}"><i class="bi bi-printer"> Print</i></button>
        </div>
        <div class="card" id="" style="padding: 6%;">
            <div class="card-body">
                <div class="col-xl-12 mx-auto">
                    <div class="d-flex justify-content-center">
                        @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                        <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                        @endif
                        <div class="text-center">
                            @if( app()->getLocale() == 'en')
                            <h2 style="font-weight: bold;text-transform: uppercase">
                                {{$school->school_name}}
                            </h2>
                            <p style="margin-top:-5px !important;font-size:12px">{{$school->slogan}}</p>
                            <p style="margin-top:-5px !important;font-size:14px">{{$school->address}}</p>
                            <div class="row text-center">
                                <h6 style="margin-top:5px !important;font-size:22px;margin-bottom:10px;">{{ $syllabus->first()->first()->classRelation->class_name }} {{__('app.Syllabus')}}</h6>
                            </div>
                            @else
                            <h4>{{$school->school_name_bn}}</h4>
                            <p style="margin-top:-5px !important;font-size:12px">{{$school->slogan_bn}}</p>
                            <p style="margin-top:-5px !important;font-size:14px">{{$school->address_bn}}</p>
                            <div class="row text-center">
                                <h6 style="margin-top:5px !important;font-size:22px;margin-bottom:10px;">{{ $syllabus->first()->first()->classRelation->class_name_bn }} {{__('app.Syllabus')}}</h6>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="print_syllabus" class="border p-3 rounded text-dark">
                        @foreach($syllabus as $key => $items)
                        <center>
                            <h5 style="font-weight: bold;text-transform: uppercase;text-decoration: underline;">
                                {{\App\Models\ResultSetting::find($key)?->title}}
                            </h5>
                        </center>
                        @foreach($items as $key => $item)
                        <div class="row" style="border:none;">
                            <div class="col-10">
                                <h6 style="font-weight: bold;text-transform: uppercase;text-decoration: underline;">
                                    {{$item->SubjectRelation->subject_name}}
                                </h6>
                                {{-- @dd($item->syllabus) --}}
                                <p>{!! $item->Syllabus !!}</p>
                            </div>
                            <div class="col-2" id="divToHide">
                                @if (hasPermission("syllabus_edit"))
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"><i class="bi bi-pencil-square"></i></a>
                                @endif
                                @if (hasPermission("syllabus_delete"))
                                <a href="" class="btn btn-danger" onclick="if(confirm('Are you sure? you are going to delete this record')){ location.replace( '{{route('syllabus.delete',$item->id) }}' ); }">
                                    <i class="bi bi-trash-fill"></i> </a>
                                @endif

                            </div>

                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="post" action="{{ route('syllabus.test.update') }}">
                                                @csrf

                                                <input type="hidden" value="{{$class->id}}" id="class_id" name="class_id">
                                                <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                                <input type="hidden" value="{{$item->subject_id}}" id="subject_id" name="subject_id">
                                                <input type="hidden" value="{{$item->term_id}}" id="term_id" name="term_id">

                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{ __('app.Write') }}
                                                        {{ __('app.Syllabus') }}</label>
                                                    <textarea class="form-control" id="syllabus" name="syllabus" rows="3">{!!$item->Syllabus!!}</textarea>
                                                    @error('syllabus')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <br>
                                                <div class="col-5">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="printDiv" style="padding: 6%;visibility: hidden;">
            <div class="card-body">
                <div class="col-xl-12 mx-auto">
                    <div class="d-flex justify-content-center">
                        @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                        <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                        @endif
                        <div class="text-center">
                            @if( app()->getLocale() == 'en')
                            <h2 style="font-weight: bold;text-transform: uppercase">
                                {{$school->school_name}}
                            </h2>
                            <p style="margin-top:-5px !important;font-size:12px">{{$school->slogan}}</p>
                            <p style="margin-top:-5px !important;font-size:14px">{{$school->address}}</p>
                            <div class="row text-center">
                                <h6 style="margin-top:5px !important;font-size:22px;margin-bottom:10px;">{{ $syllabus->first()->first()->classRelation->class_name }} {{__('app.Syllabus')}}</h6>
                            </div>
                            @else
                            <h4>{{$school->school_name_bn}}</h4>
                            <p style="margin-top:-5px !important;font-size:12px">{{$school->slogan_bn}}</p>
                            <p style="margin-top:-5px !important;font-size:14px">{{$school->address_bn}}</p>
                            <div class="row text-center">
                                <h6 style="margin-top:5px !important;font-size:22px;margin-bottom:10px;">{{ $syllabus->first()->first()->classRelation->class_name_bn }} {{__('app.Syllabus')}}</h6>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="print_syllabus" class="border p-3 rounded text-dark">
                        @foreach($syllabus as $key => $items)
                        <center>
                            <h5 style="font-weight: bold;text-transform: uppercase;text-decoration: underline;">
                                {{\App\Models\ResultSetting::find($key)?->title}}
                            </h5>
                        </center>
                        @foreach($items as $key => $item)
                        <div class="row" style="border:none;">
                            <div class="col-10">
                                <h6 style="font-weight: bold;text-transform: uppercase;">
                                    {{$item->SubjectRelation->subject_name}}
                                </h6>
                                <p>{!! $item->Syllabus !!}</p>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@push('js')

<script>
    function printDiv(printDiv) {
        var divToHide = document.getElementById('divToHide');
        var originalDisplay = divToHide.style.display;
        divToHide.style.display = 'none';
        var printContents = document.getElementById('printDiv').innerHTML;

        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        divToHide.style.display = originalDisplay;
        window.onafterprint = function() {
            divToHide.style.display = originalDisplay;
        };

        document.body.innerHTML = originalContents;

    }
</script>

<script src="{{asset('js/printThis.js')}}"></script>

{{-- <script>
    function printDiv(printDiv) {
        toastr.success("Generating ...");

        $("#printable_content").html($("#print_syllabus").html());
        $("#printable_content #action_table_th").remove();
        $("#printable_content .action_table_td").remove();
        $("#printable_content #action_div").remove();
        $("#printable_content .modal-content").remove();

        $("#printable_content").printThis({
            header: `<center>
                        <div class="d-flex justify-content-center">
                            @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
@endif
<div class="text-center">
    @if( app()->getLocale() == 'en')
    <h4>{{$school->school_name}}</h4>
    <p style="margin-top:-5px !important;font-size:12px">{{$school->slogan}}</p>
    <p style="margin-top:-5px !important;font-size:14px">{{$school->address}}</p>
    <div class="row text-center">
        <h6 style="margin-top:5px !important;font-size:22px;margin-bottom:10px;">{{ $syllabus->first()->first()->classRelation->class_name }} {{__('app.Syllabus')}}</h6>
    </div>
    @else
    <h4>{{$school->school_name_bn}}</h4>
    <p style="margin-top:-5px !important;font-size:12px">{{$school->slogan_bn}}</p>
    <p style="margin-top:-5px !important;font-size:14px">{{$school->address_bn}}</p>
    <div class="row text-center">
        <h6 style="margin-top:5px !important;font-size:22px;margin-bottom:10px;">{{ $syllabus->first()->first()->classRelation->class_name_bn }} {{__('app.Syllabus')}}</h6>
    </div>
    @endif
</div>
</div>
</center>`,
footer: `<div class="d-flex justify-content-between">
    <small class="m-0" style="float:left;">This is auto generated copy.</small>
    <small class="m-0" style="float:right;">Powered by {{env('APP_NAME')}}</small>
</div>`
});
}
</script> --}}

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- 
<script>
    CKEDITOR.replace('syllabus');
</script> -->
@endpush