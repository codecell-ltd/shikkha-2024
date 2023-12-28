@if (App\Models\AddonModel::where('feature_id', 10)->where('status', 1)->exists())
                                    @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 10)->where('status', 1)->exists())
                                        <a href="{{ route('school.Routine.view') }}" class="list-group-item @if (Request::route()->getName() == 'school.Routine.view') submenu active @endif ">
                            <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                            {{ __('app.School') }} {{ __('app.Routine') }}
                            {{ __('app.Show') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('school.Routine.view') }}" class="list-group-item @if (Request::route()->getName() == 'school.Routine.view') submenu active @endif @if (App\Models\FeatureList::where('id', 10)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.School') }} {{ __('app.Routine') }}
                                {{ __('app.Show') }}
                            </a>
                            @endif