@if (App\Models\AddonModel::where('feature_id', 15)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 15)->where('status', 1)->exists())
                            <a href="{{ route('school.staff.List') }}" class="list-group-item @if (Request::route()->getName() == 'school.staff.List') submenu active @endif @if (App\Models\FeatureList::where('id', 15)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Stuff') }} {{ __('app.List') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('school.staff.List') }}" class="list-group-item @if (Request::route()->getName() == 'school.staff.List') submenu active @endif @if (App\Models\FeatureList::where('id', 15)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Stuff') }} {{ __('app.List') }}
                            </a>
                            @endif