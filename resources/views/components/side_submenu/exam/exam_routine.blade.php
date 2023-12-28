@if (App\Models\AddonModel::where('feature_id', 47)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 47)->where('status', 1)->exists())
                            <a href="{{ route('exam.routine.create') }}" class="list-group-item ">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Exam') }} {{ __('app.Routine') }} {{ __('app.Create') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('exam.routine.create') }}" class="list-group-item  @if (App\Models\FeatureList::where('id', 47)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Exam') }} {{ __('app.Routine') }} {{ __('app.Create') }}
                            </a>
                            @endif