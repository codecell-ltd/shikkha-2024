
<a href="{{ route('online.Admission.Form.list') }}" class="list-group-item @if (Request::route()->getName() == 'online.Admission.Form.list') submenu active @endif  @if (App\Models\FeatureList::where('id', 3)->where('status', 0)->exists()) deasableFeature @endif">
    <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
    {{ __('app.Admission') }} {{ __('app.Request') }}
</a>
