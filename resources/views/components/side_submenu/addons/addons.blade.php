<a href="{{ route('SchoolAddon') }}" class="list-group-item  @if (App\Models\FeatureList::where('id', 63)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Addon') }}
                            </a>