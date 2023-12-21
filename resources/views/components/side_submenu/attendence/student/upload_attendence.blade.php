@if (App\Models\AddonModel::where('feature_id', 20)->where('status', 1)->exists())
                                    @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 20)->where('status', 1)->exists())
                                        <a href="javascript::" data-bs-target="#attendance-upload-modal"
                                            data-bs-toggle="modal" class="list-group-item ">
                                            <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                            {{ __('app.upload_attendance') }}
                            </a>
                            @endif
                            @else
                            <a href="javascript::" data-bs-target="#attendance-upload-modal" data-bs-toggle="modal" class="list-group-item  @if (App\Models\FeatureList::where('id', 20)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.upload_attendance') }}
                            </a>
                            @endif
