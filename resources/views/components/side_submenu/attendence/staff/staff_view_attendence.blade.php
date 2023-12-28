@if (App\Models\AddonModel::where('feature_id', 28)->where('status', 1)->exists())
                                @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 28)->where('status', 1)->exists())
                                <a href="{{ route('StaffAttendance.AllView') }}" class="list-group-item @if (Request::route()->getName() == 'StaffAttendance.AllView') submenu active @endif">
                                    <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                    {{ __('app.ViewAttendance') }}
                                </a>
                                @endif
                                @else
                                <a href="{{ route('StaffAttendance.AllView') }}" class="list-group-item @if (Request::route()->getName() == 'StaffAttendance.AllView') submenu active @endif @if (App\Models\FeatureList::where('id', 28)->where('status', 0)->exists()) deasableFeature @endif">
                                    <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                    {{ __('app.ViewAttendance') }}
                                </a>
                                @endif