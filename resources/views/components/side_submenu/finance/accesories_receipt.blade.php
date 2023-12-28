
@if (App\Models\AddonModel::where('feature_id', 40)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 40)->where('status', 1)->exists())
                            <a href="{{ route('reciept.create') }}" class="list-group-item @if (Request::route()->getName() == 'reciept.create') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Accessories') }} {{ __('app.Receipt') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('reciept.create') }}" class="list-group-item @if (Request::route()->getName() == 'reciept.create') submenu active @endif @if (App\Models\FeatureList::where('id', 40)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Accessories') }} {{ __('app.Receipt') }}
                            </a>
                            @endif