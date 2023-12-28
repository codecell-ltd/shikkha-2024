{{-- @if (AddonModel::where('feature_id', 19)->where('status', 1)->exists())
    @if (AddonPurchase::where('school_id', Auth::user()->id)->where('feature_id', 19)->where('status', 1)->exists()) --}}
        <a href="{{ route('student.attendance.show.date.all') }}"
            class="list-group-item @if (Request::route()->getName() == 'student.attendance.show.date.all') submenu active @endif">
            <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
            {{ __('app.View') }} {{ __('app.Attendance') }}
        </a>
    {{-- @endif
@else
    <a href="{{ route('student.attendance.show.date.all') }}"
        class="list-group-item @if (Request::route()->getName() == 'student.attendance.show.date.all') submenu active @endif  @if (FeatureList::where('id', 19)->where('status', 0)->exists()) deasableFeature @endif">
        <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
        {{ __('app.Attendance') }}
    </a>
@endif --}}