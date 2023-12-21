@extends('layouts.school.master')

@section('content')
    <style>
        .card.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        .card-title1:hover {
            color: blueviolet;
        }

        .card-text {
            font-family: 'Pacifico', cursive;
            font-family: 'Poppins', sans-serif;
        }

        .card-text1:hover {
            color: rgb(132, 104, 132);
        }

        .card {
            transition: transform .2s;


        }

        button.detailbtn {
            background: none;
            border: none;
            color: blueviolet;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .disablebtn {
            opacity: 0.4;
            pointer-events: none;
        }

        .Pendingbtn {
            opacity: 0.6;
            pointer-events: none;
            background: rgb(251, 194, 6);
            border-color: rgb(251, 194, 6);
        }

        .activecard {
            background-image: linear-gradient(to right, rgba(255, 0, 0, 0), rgb(237, 126, 228));
        }

        .pendingcard {
            background-image: linear-gradient(to right, rgba(255, 0, 0, 0), rgb(244, 227, 140));
        }
    </style>
    <main class="page-content">
        <div class="row">
            @foreach ($addons as $addon)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card  @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('addon_id', $addon->id)->where('status', 1)->exists()) activecard  @elseif (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('addon_id', $addon->id)->where('status', 0)->exists()) pendingcard @else purchasecard @endif"
                        style="width: 20rem;border-radius:20px">
                        <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch demo modal
                        </button> --}}


                        <img src="{{ asset($addon->image ?? 'd/no-img.jpg') }}" class="card-img-top" alt=""
                            style="border-top:2px;border-left:2px;border-right:2px;border-top-left-radius: 20px;border-top-right-radius: 20px;">
                        <div class="card-body">
                            <h3 class="card-title1">{{ $addon->title }}</h3>
                            <p class="card-text1">{!! $addon->description !!}</p>
                            <button type="button" class="detailbtn" data-bs-toggle="modal"
                                data-bs-target="#details{{ $addon->id }}">
                                Details <i class="bi bi-arrow-right"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="details{{ $addon->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="card-text1">{!! $addon->longdescription !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($addon->button == 1)
                                {{-- this button will be use after bkash add --}}
                                {{-- <button class="btn btn-primary"
                                        onclick="showModal('{{ $addon->id }}')">Purchase</button> --}}
                                <div class="d-flex justify-content-between gap-3">
                                    @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('addon_id', $addon->id)->where('status', 1)->exists())
                                        <button type="button"
                                            class="btn btn-primary 
                                         disablebtn  "
                                            data-bs-toggle="modal" data-bs-target="#addon{{ $addon->id }}">
                                            Active
                                        </button>
                                    @elseif(App\Models\AddonPurchase::where('school_id', authUser()->id)->where('addon_id', $addon->id)->where('status', 0)->exists())
                                        <button type="button"
                                            class="btn btn-primary 
                                         Pendingbtn  "
                                            data-bs-toggle="modal" data-bs-target="#addon{{ $addon->id }}">
                                            Pending
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addon{{ $addon->id }}">
                                            Purchase
                                        </button>
                                    @endif
                                    <h4 class="card-title fw-bold">{{ $addon->price }} <strong
                                            style="font-size:16px">৳</strong>
                                    </h4>
                                </div>

                                <!-- sure purchase Modal -->
                                <div class="modal fade" id="addon{{ $addon->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:blueviolet;">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color:white;">
                                                    Addon purchase</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" style="color:white;"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('SchoolAddon.Purchase') }}" method="post">
                                                    @csrf
                                                    <h5>Do you Really want to purchase <br> this Addon?</h5>
                                                    <input type="hidden" name="addon_id" value="{{ $addon->id }}">
                                                    <input type="hidden" name="feature_id"
                                                        value="{{ $addon->feature_id }}">
                                                    <input type="hidden" name="price" value="{{ $addon->price }}">
                                                    <input type="hidden" name="school_id" value="{{ authUser()->id }}">
                                                    <input type="hidden" name="status" value="0">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">{{ __('app.no') }}</button>
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm">{{ __('app.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex justify-content-between gap-3">
                                    <button class="btn btn-info">Free</button>
                                    <h4 class="card-title fw-bold">{{ $addon->price }} <strong
                                            style="font-size:16px">৳</strong>
                                    </h4>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </main>




    <!-- Modal -->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="height: 700px;">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0 m-0">

                </div>
            </div>
        </div>
    </div>
    <script>
        function showModal(id) {

            //console.log(addoncheckoutinfo);

            $.ajax({
                url: '/Addon/Checkout/School',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    addon_package_id: id
                },
                success: function(response) {
                    console.log(response);
                    // update modal content
                    $('#myModal .modal-body').html(response);
                    // show modal
                    $('#myModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
    {{-- <script>
    function showModal(id) {
        $.ajax({
            url: '/Addon/Checkout/School/' + id, 
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched HTML
                $('#myModal .modal-content').html(response);
                // Show the modal
                $('#myModal').modal('show');
            }
        });
    }
</script> --}}
@endsection
