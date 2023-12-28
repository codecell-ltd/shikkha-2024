
@if (App\Models\AddonModel::where('feature_id', 38)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 38)->where('status', 1)->exists())
                            <a href="{{ route('fund.show') }}" class="list-group-item @if (Request::route()->getName() == 'fund.show') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Funds') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('fund.show') }}" class="list-group-item @if (Request::route()->getName() == 'fund.show') submenu active @endif @if (App\Models\FeatureList::where('id', 38)->where('status', 0)->exists()) deasableFeature @endif ">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Funds') }}
                            </a>
                            @endif