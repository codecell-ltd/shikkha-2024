@if (App\Models\AddonModel::where('feature_id', 48)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 48)->where('status', 1)->exists())
                            <a href="{{ route('create.question.show') }}" class="list-group-item ">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Question') }} {{ __('app.Create') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('create.question.show') }}" class="list-group-item  @if (App\Models\FeatureList::where('id', 48)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Question') }} {{ __('app.Create') }}
                            </a>
                            @endif