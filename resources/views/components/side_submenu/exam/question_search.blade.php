@if (App\Models\AddonModel::where('feature_id', 65)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 64)->where('status', 1)->exists())
                            <a href="{{ route('question.searchpage') }}" class="list-group-item ">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Question Searchpage') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('question.searchpage') }}" class="list-group-item  @if (App\Models\FeatureList::where('id', 65)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Question Searchpage') }}
                            </a>
                            @endif