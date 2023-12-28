@if (App\Models\AddonModel::where('feature_id', 51)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 51)->where('status', 1)->exists())
                            <a href="{{ route('show.sit.plan') }}" class="list-group-item ">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Sit Plan') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('show.sit.plan') }}" class="list-group-item  @if (App\Models\FeatureList::where('id', 51)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Sit Plan') }}
                            </a>
                            @endif