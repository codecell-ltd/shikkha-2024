<div>
    @if (App\Models\AddonModel::where('feature_id', 56)->where('status', 1)->exists())
    @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 56)->where('status', 1)->exists())
    <a href="{{route("notice.school.admin.create.show")}}" class="list-group-item ">
        <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
        {{ __('app.Notice') }}
    </a>
    @endif
    @else
    <a href="{{route("notice.school.admin.create.show")}}" class="list-group-item  @if (App\Models\FeatureList::where('id', 56)->where('status', 0)->exists()) deasableFeature @endif">
        <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
        {{ __('app.Notice') }}
    </a>
    @endif
</div>