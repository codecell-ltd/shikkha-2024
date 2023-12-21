@if (App\Models\AddonModel::where('feature_id', 29)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 29)->where('status', 1)->exists())
                            <a href="{{ route('school.finance.dashoboard') }}" class="list-group-item @if (Request::route()->getName() == 'school.finance.dashboard') submenu active @endif @if (Request::route()->getName() == 'school.finance.dashoboard') submenu active @endif ">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.dashboard') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('school.finance.dashoboard') }}" class="list-group-item @if (Request::route()->getName() == 'school.finance.dashboard') submenu active @endif @if (Request::route()->getName() == 'school.finance.dashoboard') submenu active @endif  @if (App\Models\FeatureList::where('id', 29)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.dashboard') }}
                            </a>
                            @endif
