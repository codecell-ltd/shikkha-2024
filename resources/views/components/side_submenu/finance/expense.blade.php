@if (App\Models\AddonModel::where('feature_id', 36)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 36)->where('status', 1)->exists())
                            <a href="{{ route('expense.show') }}" class="list-group-item @if (Request::route()->getName() == 'expense.show') submenu active @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Expenses') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('expense.show') }}" class="list-group-item @if (Request::route()->getName() == 'expense.show') submenu active @endif @if (App\Models\FeatureList::where('id', 36)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-box-arrow-in-right"></i></div>
                                {{ __('app.Expenses') }}
                            </a>
                            @endif