@extends('layouts.school.master')

@push('js')
    @include('frontend.school.student.Attendancedashboard.include.teacher_list_script')
@endpush

@section('content')
    <main class="page-content">
        <h4 class="mb-4 text-primary">Teachers</h4>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body bg-primary text-light">
                        
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card mb-0">
                                    <div class="card-body text-dark">
                                        <div class="d-flex justify-content-between gap-1 align-items-center">
                                            <div> <img src="{{asset('assets/nav-icons/student.svg')}}" alt="student" width="40"> <h6>Connected Teachers </h6></div>
                                            
                                            <h3 class="m-0" id="connected_user_card">0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-0">
                                    <div class="card-body text-dark">
                                        <div class="d-flex justify-content-between gap-1 align-items-center">
                                            <div> <img src="{{asset('assets/nav-icons/student.svg')}}" alt="student" width="40"> <h6>Disconnected Teachers </h6></div>
                                            
                                            <h3 class="m-0" id="disconnected_user_card">0</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body table-responsive">

                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>No.</th>
                                <th>Teacher</th>
                                <th>Shift</th>
                                {{-- <th>UID</th> --}}
                                <th>Connection</th>
                            </thead>
                            <tbody id="userListId">

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="loader" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="background: none">
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-grow text-primary me-3" role="status" aria-hidden="true"></div>
                        <h5 class="m-0 text-primary">Just a moment, Please...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')

    <script src="{{asset('js/printThis.js')}}"></script>

    <script>

        function printDiv(printDiv) {
            toastr.success("Generating ...");

            $("#printable_content").html($("#attendance_body").html());
            $("#printable_content #action_table_th").remove();
            $("#printable_content .action_table_td").remove();

            $("#printable_content").printThis({
                footer: `<div class="d-flex justify-content-between">
                            <small class="m-0">This is auto generated copy.</small>
                            <small class="m-0">Powered by {{env('APP_NAME')}}</small>
                        </div>`
            });
        }
    </script>
@endpush
