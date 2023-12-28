
                            
                            {{-- <a href="{{route('group.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-network-chart"></i>{{__('app.Group')}} {{__('app.Show')}}</a> --}}
                            {{-- <a href="{{route('department.show')}}" class="list-group-item"><i class="lni lni-control-panel"></i>Show Department</a> --}}
                            @if (App\Models\AddonModel::where('feature_id', 6)->where('status', 1)->exists())
                            @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 6)->where('status', 1)->exists())
                            <a href="{{ route('syllabus.test.list') }}" class="list-group-item @if (Request::route()->getName() == 'syllabus.test.list') submenu active @endif ">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Syllabus') }}
                            </a>
                            @endif
                            @else
                            <a href="{{ route('syllabus.test.list') }}" class="list-group-item  @if (Request::route()->getName() == 'syllabus.test.list') submenu active @endif @if (App\Models\FeatureList::where('id', 6)->where('status', 0)->exists()) deasableFeature @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('app.Syllabus') }}
                            </a>
                            @endif