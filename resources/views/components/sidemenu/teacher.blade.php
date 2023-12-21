@if (App\Models\AddonModel::where('feature_id', 13)->where('status', 1)->exists())
                        @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 13)->where('status', 1)->exists())
                            <li class="nav-item mb-2 text-center @if (App\Models\FeatureList::where('id', 13)->where('status', 0)->exists()) deasableFeature @endif"
                                data-bs-toggle="tooltip" data-bs-placement="right" title="{{ __('app.Teacher') }}">
                                <a href="javascript::"><button class="nav-link mb-0"
                                        data-bs-toggle="pill" data-bs-target="#pills-teacher" type="button"><img
                                            src="{{ asset('assets/nav-icons-white/teacher.svg') }}" alt="teacher"
                                            width="20"></button></a>
                                <br> {{ __('app.Teacher') }}
                            </li>
                        @endif
                    @else
                        <li class="nav-item mb-2 text-center @if (App\Models\FeatureList::where('id', 13)->where('status', 0)->exists()) deasableFeature @endif"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="{{ __('app.Teacher') }}">
                            <a href="javascript::"><button class="nav-link mb-0"
                                    data-bs-toggle="pill" data-bs-target="#pills-teacher" type="button"><img
                                        src="{{ asset('assets/nav-icons-white/teacher.svg') }}" alt="teacher"
                                        width="20"></button></a>
                            <br> {{ __('app.Teacher') }}
                        </li>
                    @endif