
@if (App\Models\AddonModel::where('feature_id', 16)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 16)->where('status', 1)->exists())
                            <a href="{{ route('school.staff.show') }}" class="list-group-item @if (Request::route()->getName() == 'school.staff.show') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Stuff') }} {{ __('app.Type') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('school.staff.show') }}" class="list-group-item @if (Request::route()->getName() == 'school.staff.show') submenu active @endif @if (App\Models\FeatureList::where('id', 16)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Stuff') }} {{ __('app.Type') }}
                            </a>
                            @endif