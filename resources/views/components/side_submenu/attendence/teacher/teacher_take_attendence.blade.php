
@if (App\Models\AddonModel::where('feature_id', 25)->where('status', 1)->exists())
                                @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 25)->where('status', 1)->exists())
                                <a href="{{ route('Teacher.datepage') }}" class="list-group-item @if (Request::route()->getName() == 'Teacher.datepage') submenu active @endif">
                                    <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                    {{ __('app.TakeAttendance') }}
                                </a>
                                @endif
                                @else
                                <a href="{{ route('Teacher.datepage') }}" class="list-group-item @if (Request::route()->getName() == 'Teacher.datepage') submenu active @endif @if (App\Models\FeatureList::where('id', 25)->where('status', 0)->exists()) deasableFeature @endif">
                                    <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                    {{ __('app.TakeAttendance') }}
                                </a>
                                @endif
