@if (App\Models\AddonModel::where('feature_id', 55)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 55)->where('status', 1)->exists())
                            <a href="{{ route('result.pdf') }}" class="list-group-item">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>Result
                                Pdf
                            </a>
                            @endif
                            @else
                            <a href="{{ route('result.pdf') }}" class="list-group-item   @if (App\Models\FeatureList::where('id', 55)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>Result
                                Pdf
                            </a>
                            @endif