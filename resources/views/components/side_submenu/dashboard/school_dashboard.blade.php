 @if (App\Models\AddonModel::where('feature_id', 1)->where('status', 1)->exists())
 @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 1)->where('status', 1)->exists())
 <a href="{{ route('school.dashboard') }}" class="list-group-item @if (Request::route()->getName() == 'school.dashboard') submenu active @endif">
     <div class="imgbox"><i class="bi bi-chevron-double-right"></i>
     </div>
     {{ __('app.dashboard') }}
 </a>
 @endif
 @else
 <a href="{{ route('school.dashboard') }}" class="list-group-item @if (Request::route()->getName() == 'school.dashboard') submenu active @endif @if (App\Models\FeatureList::where('id', 1)->where('status', 0)->exists()) deasableFeature @endif">
     <div class="imgbox"><i class="bi bi-chevron-double-right"></i>
     </div>
     {{ __('app.dashboard') }}
 </a>
 @endif

