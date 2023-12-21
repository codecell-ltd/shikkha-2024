@if (App\Models\AddonModel::where('feature_id', 32)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 32)->where('status', 1)->exists())
                            <a href="{{ route('school.finance.userlist') }}" class="list-group-item  @if (Request::route()->getName() == 'school.finance.userlist') submenu active @endif @if (Request::route()->getName() == 'school.finance.userlist') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.collect_fees') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('school.finance.userlist') }}" class="list-group-item @if (Request::route()->getName() == 'school.finance.userlist') submenu active @endif @if (Request::route()->getName() == 'school.finance.userlist') submenu active @endif  @if (App\Models\FeatureList::where('id', 32)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.collect_fees') }}
                            </a>
                            @endif