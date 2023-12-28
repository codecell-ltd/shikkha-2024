 
                <li class="nav-item mb-2 text-center @if (App\Models\FeatureList::where('id', 63)->where('status', 0)->exists()) deasableFeature @endif" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ __('app.Addon') }}">
                    <a href="{{ route('SchoolAddon') }}"><button class="nav-link mb-0" data-bs-toggle="pill" data-bs-target="#pills-SchoolAddon" type="button"><img src="{{ asset('assets/nav-icons-white/addons.svg') }}" alt="addons" width="20"></button></a>
                    <br>{{ __('app.Addon') }}
                </li>