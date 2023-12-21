{{-- Role Management Start by Sajjad --}}
                @if (App\Models\AddonModel::where('feature_id', 58)->where('status', 1)->exists())
                @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 58)->where('status', 1)->exists())
                <li class="nav-item mb-2 text-center @if (App\Models\FeatureList::where('id', 58)->where('status', 0)->exists()) deasableFeature @endif" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ __('app.Role') }}">
                    <a href="{{ route('roles.index') }}"><button class="nav-link mb-0" data-bs-toggle="pill" data-bs-target="#pills-role" type="button"><img src="{{ asset('assets/nav-icons-white/library.svg') }}" alt="role" width="20"></button></a>
                    <br>{{ __('app.Role') }}
                </li>
                @endif
                @else
                <li class="nav-item mb-2 text-center @if (App\Models\FeatureList::where('id', 58)->where('status', 0)->exists()) deasableFeature @endif" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ __('app.Role') }}">
                    <a href="{{ route('roles.index') }}"><button class="nav-link mb-0" data-bs-toggle="pill" data-bs-target="#pills-role" type="button"><img src="{{ asset('assets/nav-icons-white/library.svg') }}" alt="role" width="20"></button></a>
                    <br>{{ __('app.Role') }}
                </li>
                @endif
                {{-- Role Management End by Sajjad --}}
