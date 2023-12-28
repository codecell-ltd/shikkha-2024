
@if (App\Models\AddonModel::where('feature_id', 12)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 12)->where('status', 1)->exists())
                            <a href="{{ route('student.create') }}" class="list-group-item @if (Request::route()->getName() == 'student.create') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Student') }} {{ __('app.Create') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('student.create') }}" class="list-group-item @if (Request::route()->getName() == 'student.create') submenu active @endif @if (App\Models\FeatureList::where('id', 12)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Student') }} {{ __('app.Create') }}
                            </a>
                            @endif