
@if (App\Models\AddonModel::where('feature_id', 41)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 41)->where('status', 1)->exists())
                            <a href="{{ route('student.finance.status') }}" class="list-group-item @if (Request::route()->getName() == 'student.finance.status') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Student') }} {{ __('app.Finance') }} {{ __('app.Status') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('student.finance.status') }}" class="list-group-item @if (Request::route()->getName() == 'student.finance.status') submenu active @endif @if (App\Models\FeatureList::where('id', 41)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Student') }} {{ __('app.Finance') }} {{ __('app.Status') }}
                            </a>
                            @endif